@extends('layouts.master')

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

                <div class="box">
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
                    <p>payment status : <span
                            style="color: {{$order['status'] == 0 ? 'red' : 'green'}}">{{$order['status'] == 0 ? "pending" : "complete"}}</span>
                    </p>
                </div>
            @endforeach
        @else
            <p class="empty">no orders placed yet!</p>
        @endif
    </div>
</section>
@endsection