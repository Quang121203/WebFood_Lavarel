@extends('layouts.master')

@section('content')
<section class="home">
    <div class="swiper home-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide slide">
                <div class="content">
                    <span>order online</span>
                    <h3>delicious cake</h3>
                    <a href="/menu" class="btn">see menu</a>
                </div>
                <div class="image">
                    <img src="images/home-img-1.png" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>order online</span>
                    <h3>sweet candy</h3>
                    <a href="/menu" class="btn">see menu</a>
                </div>
                <div class="image">
                    <img src="images/home-img-2.png" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>order online</span>
                    <h3>marvelous dessert</h3>
                    <a href="/menu" class="btn">see menu</a>
                </div>
                <div class="image">
                    <img src="images/home-img-3.png" alt="">
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="category">
    <h1 class="title">category</h1>
    <div class="box-container">
        @foreach ($categories as $category)
            <a href="/product/category/{{$category['id']}}" class="box">
                <img src="{{asset('storage/categories/' . $category->img)}}" alt="{{$category->name}}">
                <h3>{{$category->name}}</h3>
            </a>
        @endforeach
    </div>
</section>

<section class="products">
    <h1 class="title">latest</h1>
    @include('components.home.product', ['products' => $products])
    <div class="more-btn">
        <a href="/menu" class="btn">view all</a>
    </div>
</section>

@endsection

@push('my_script')
    <script>
        var swiper = new Swiper(".home-slider", {
            loop: true,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
@endpush