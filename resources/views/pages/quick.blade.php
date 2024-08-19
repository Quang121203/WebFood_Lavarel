@extends('layouts.master')

@section('content')
<section class="quick-view">
    <h1 class="title">quick view</h1>
    <form action="" method="post" class="box">
        <img src="{{asset('storage/products/cake 01.png')}}" alt="">
        <a href="#" class="cat">Cat</a>
        <div class="name">Name</div>
        <div class="flex">
            <div class="price">Price<span>VND</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
        </div>
        <button type="submit" name="add_to_cart" class="cart-btn">add to cart</button>
    </form>
</section>
@endsection