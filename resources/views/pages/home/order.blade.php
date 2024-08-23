@extends('layouts.master')
<style>
    .box {
        position: relative;
    }

    .fa-times {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background-color: var(--red);
        color: var(--white);
        border: var(--border);
        line-height: 4rem;
        height: 4.3rem;
        width: 4.5rem;
        cursor: pointer;
        font-size: 2rem;
    }

    .fa-times:hover {
        background-color: var(--black);
        color: var(--white);
    }
</style>
@section('content')
<div class="heading">
    <h3>orders</h3>
</div>

<section class="orders">
    <h1 class="title">your orders</h1>
    <div class="box-container">
        @if($orders)
            @foreach($orders as $order)
                @php
                    $date = new DateTime($order['created_at']);
                    $formattedDate = $date->format('d-m-Y');
                @endphp

                <div class="box" id="{{'order_' . $order['id']}}">
                    <!-- @if ($order['status'] <= 1 || $order['status'] == 4)
                        <button class="fas fa-times" onclick="deleteOrder({{$order['status']}},{{$order['id']}})"></button>
                    @endif -->
                    <p>placed on : <span>{{$formattedDate}}</span></p>
                    <p>name : <span>{{$order['name']}}</span></p>
                    <p>email : <span>{{$order['email']}}</span></p>
                    <p>phone : <span>{{$order['phone']}}</span></p>
                    <p>address : <span>{{$order['address']}}</span></p>
                    <p>your orders :
                        @foreach($order['product'] as $index => $product)
                            <span>
                                {{ $product['name'] }} ({{ $product['quantity'] }})
                                @if($index < count($order['product']) - 1)
                                    -
                                @endif
                            </span>
                        @endforeach
                    </p>
                    <p>total price :{{$order['total']}} <span>VND</span></p>
                    <p>payment status :
                        <span style="color: {{['red', 'black', 'yellow', 'var(--yellow)', 'green'][$order['status']]}}">
                            {{ ['Order canceled', 'pending', 'Order confirmed', 'Order in transit', 'Order received'][$order['status']] }}
                        </span>
                    </p>
                </div>
            @endforeach
        @else
            <p class="empty">no orders placed yet!</p>
        @endif
    </div>
</section>
@endsection