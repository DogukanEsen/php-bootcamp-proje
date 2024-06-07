@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Cart</h1>

        @if (count($cartItems) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Book</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item->book->title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ $item->book->price }}</td>
                            <td>${{ $item->book->price * $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right">
                <strong>Total Price: ${{ $cartItems->sum(fn($item) => $item->book->price * $item->quantity) }}</strong>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
