@extends('layouts.master')

@section('content')
<section class="quick-view">
    <h1 class="title">content</h1>
    <form onsubmit="return false;" id="{{'form_product_' . $product->id}}" class="box">
        @CSRF
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <img alt="{{$product->name}}" src="{{asset('storage/products/' . $product->img)}}">
        <a class="cat" href="/product/category/{{$product['id']}}">{{$product->category_name}}</a>
        <div class="name">{{$product->name}}</div>
        <div class="flex">
            <div class="price">{{$product->price}}<span>VND</span></div>
            <input type="number" name="quanlity" class="number" min="1" max="99" value="1" maxlength="2">
        </div>
        <button class="cart-btn" onclick="add_to_cart({{$product->id}})">
            add to cart
        </button>
    </form>
</section>

<section style="font-size:200%">
    @php
        echo $product->content;
    @endphp
</section>
@endsection