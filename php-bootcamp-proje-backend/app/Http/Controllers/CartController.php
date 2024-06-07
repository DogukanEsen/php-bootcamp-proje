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
        $result = $this->cartService->addToCart($request, $bookId);

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }


    public function updateCartItem(Request $request, $cartItemId)
    {
        $result = $this->cartService->updateCartItem($request, $cartItemId);

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function viewCart()
    {
        $cartItems = $this->cartService->viewCart();

        return view('cart.view')->with('cartItems', $cartItems);
    }
    public function checkout()
    {
        $result = $this->cartService->checkout();
        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }
}
