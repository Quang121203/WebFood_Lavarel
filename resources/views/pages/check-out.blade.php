@extends('layouts.master')

@section('content')
<div class="heading">
    <h3>checkout</h3>
</div>
<section class="checkout">
    <h1 class="title">order summary</h1>
    <form onsubmit="return false;">
        <div class="cart-items">
            <h3>cart items</h3>
            @if(session('cart'))
                        @php
                            $total = 0;
                        @endphp
                        @foreach(session('cart') as $item)
                                <p>
                                    <span class="name">{{$item['name']}}</span>
                                    <span class="price"> {{$item['price']}} VND x {{$item['number']}}</span>
                                </p>
                                @php
                                    $total += $item['total']
                                @endphp
                        @endforeach
            @else
                <p class="empty">your cart is empty</p>
            @endif

            <p class="grand-total"><span class="name">grand total :</span>
                <span class="price">{{$total}} VND</span>
            </p>
            <a href="/cart" class="btn">view cart</a>
        </div>

        <button class="btn" style="width:100%; background:var(--red); color:var(--white);">
            place order
        </button>
    </form>
</section>
@endsection