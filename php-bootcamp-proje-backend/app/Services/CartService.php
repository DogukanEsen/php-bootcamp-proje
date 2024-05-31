<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;


class CartService
{
    public function addToCart($userId, $bookId, $quantity)
    {
        $cart = Cart::firstOrCreate(["user_id" => $userId]);

        return CartItem::create([
            "cart_id" => $cart->id,
            "book_id" => $bookId,
            "quantity" => $quantity,
        ]);
    }

    public function checkout($cartId)
    {
        //TODO: Ödeme işlemlerini burada geliştir.
        $cart = Cart::find($cartId);
        return $cart;
    }
}