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

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
        ]);

        $cartItem = CartItem::firstOrCreate([
            'cart_id' => $cart->id,
            'book_id' => $book->id,
        ], [
            'quantity' => $request->input('quantity', 1),
        ]);

        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        }
        return $book;
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

    public function checkout($cartId)
    {
        //TODO: Ödeme işlemlerini burada geliştir.
        $cart = Cart::find($cartId);
        return $cart;
    }
}