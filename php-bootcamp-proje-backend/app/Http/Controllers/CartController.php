<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(Request $request, $bookId)
    {
        $book = $this->cartService->addToCart($request, $bookId);

        return view('books.show', compact('book'));
    }
    public function viewCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return view('cart.view')->with('cartItems', []);
        }

        $cartItems = $cart->items()->with('book')->get();

        return view('cart.view')->with('cartItems', $cartItems);
    }
    public function checkout($id)
    {
        $cart = $this->cartService->checkout($id);
        return response()->json($cart);
    }
}
