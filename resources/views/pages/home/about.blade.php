@extends('layouts.master')

@section('content')
<div class="heading">
    <h3>about</h3>
</div>

<section class="about">

    <div class="row">

        <div class="image">
            <img src="{{asset('images/about-img.svg')}}" alt="">
        </div>

        <div class="content">
            <h3>why choose us?</h3>
            <p>NapoleQuang Store proudly offers you unique and high-quality dishes, crafted from the freshest
                ingredients</p>
            <a href="/menu" class="btn">our menu</a>
        </div>

    </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

    <h1 class="title">simple steps</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/step-1.png" alt="">
            <h3>choose order</h3>
            <p>Choose products.</p>
        </div>

        <div class="box">
            <img src="images/step-2.png" alt="">
            <h3>fast delivery</h3>
            <p>Wait for delivery.</p>
        </div>

        <div class="box">
            <img src="images/step-3.png" alt="">
            <h3>enjoy food</h3>
            <p>Enjoy 😋.</p>
        </div>

    </div>

</section>

<!-- steps section ends -->

<!-- reviews section starts  -->

<section class="reviews">

    <h1 class="title">customer's reivews</h1>

    <div class="swiper reviews-slider">

        <div class="swiper-wrapper">
            @foreach ($comments as $comment)
                <div class="swiper-slide slide">
                    <img src="{{ $comment['user']['img'] ? asset('storage/users/' . $comment['user']['img']) : asset('images/noAvatar.png') }}"
                        alt="">
                    <p>{{$comment->content }}</p>
                    <div class="star-rating static">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $comment->rate ? 'checked' : '' }}"></i>
                        @endfor
                    </div>
                    <h3>{{$comment['user']['name']}}</h3>
                </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>
@endsection


@push('my_script')
    <script>
        var swiper = new Swiper(".reviews-slider", {
            grabCursor: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                700: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>
@endpush