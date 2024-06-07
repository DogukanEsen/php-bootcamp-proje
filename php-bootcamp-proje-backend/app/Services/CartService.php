<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;


class CartService
{

    protected $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function addToCart($request, $bookId)
    {
        if (!Auth::check() || Auth::user()->is_admin) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $book = $this->bookService->getById($bookId);
        $quantity = $request->input('quantity', 1);

        if ($quantity > $book->quantity) {
            return ['success' => false, 'message' => 'You cannot add more items than available.'];
        }

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
        ]);

        $cartItem = $cart->items()->where('book_id', $bookId)->first();

        if ($cartItem) {
            if ($cartItem->quantity + $quantity > $book->quantity) {
                return ['success' => false, 'message' => 'You cannot add more items than available.'];
            }
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'book_id' => $bookId,
                'quantity' => $quantity,
            ]);
        }

        return ['success' => true, 'message' => 'Book added to cart.'];
    }

    public function updateCartItem($request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $quantity = $request->input('quantity');

        if ($quantity > $cartItem->book->quantity) {
            return ['success' => false, 'message' => 'You cannot add more items than available..'];
        }

        if ($quantity <= 0) {
            $cartItem->delete();
        } else {
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        return ['success' => true, 'message' => 'Cart updated.'];
    }

    public function viewCart()
    {

        if (!Auth::check() || Auth::user()->is_admin) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return view('cart.view')->with('cartItems', []);
        }

        $cartItems = $cart->items()->with('book')->get();
        return $cartItems;

    }

    public function checkout()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return ['success' => false, 'message' => 'Cart is empty.'];
        }

        foreach ($cart->items as $cartItem) {
            $book = $cartItem->book;
            if ($cartItem->quantity > $book->quantity) {
                return ['success' => false, 'message' => 'One or more items exceed available quantity.'];
            }
        }

        foreach ($cart->items as $cartItem) {
            $book = $cartItem->book;
            $book->quantity -= $cartItem->quantity;
            $book->save();
        }

        $cart->items()->delete();

        return ['success' => true, 'message' => 'Checkout successful.'];
    }
}