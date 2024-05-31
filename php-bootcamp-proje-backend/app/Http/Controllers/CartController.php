<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(Request $request)
    {
        $cartItem = $this->cartService->addToCart($request->user_id, $request->book_id, $request->quantity);
        return response()->json($cartItem, 201);
    }
    public function checkout($id)
    {
        $cart = $this->cartService->checkout($id);
        return response()->json($cart);
    }
}
