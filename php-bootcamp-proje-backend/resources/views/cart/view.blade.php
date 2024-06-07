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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item->book->title }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}"
                                        class="btn btn-sm btn-primary">-</button>
                                </form>
                                <span>{{ $item->quantity }}</span>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}"
                                        class="btn btn-sm btn-primary">+</button>
                                </form>
                            </td>
                            <td>${{ $item->book->price }}</td>
                            <td>${{ $item->book->price * $item->quantity }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="quantity" value="0">
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right">
                <strong>Total Price: ${{ $cartItems->sum(fn($item) => $item->book->price * $item->quantity) }}</strong>
            </div>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Checkout</button>
            </form>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
