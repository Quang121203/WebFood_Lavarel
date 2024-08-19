@extends('layouts.master')

@section('content')
<section class="home">
    <div class="swiper home-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide slide">
                <div class="content">
                    <span>order online</span>
                    <h3>delicious cake</h3>
                    <a href="menu.php" class="btn">see menu</a>
                </div>
                <div class="image">
                    <img src="images/home-img-1.png" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>order online</span>
                    <h3>sweet candy</h3>
                    <a href="menu.php" class="btn">see menu</a>
                </div>
                <div class="image">
                    <img src="images/home-img-2.png" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>order online</span>
                    <h3>marvelous dessert</h3>
                    <a href="menu.php" class="btn">see menu</a>
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
            <a href="#" class="box">
                <img src="{{asset('storage/categories/' . $category->img)}}" alt="{{$category->name}}">
                <h3>{{$category->name}}</h3>
            </a>
        @endforeach
    </div>
</section>

<section class="products">
    <h1 class="title">latest</h1>
    <div class="box-container">
        @foreach ($products as $product)
            <form onsubmit="return false;" id="{{'form_product_' . $product->id}}" class="box">
                @CSRF
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <a class="fas fa-eye"></a>
                <button type="submit" class="fas fa-shopping-cart" onclick="add_to_cart({{$product->id}})" ></button>
                <img alt="{{$product->name}}" src="{{asset('storage/products/' . $product->img)}}">
                <a class="cat">{{$product->category_name}}</a>
                <div class="name">{{$product->name}}</div>
                <div class="flex">
                    <div class="price">{{$product->price}}<span> VND</span></div>
                    <input type="number" name="number" class="number" min="1" max="99" value="1" maxlength="2">
                </div>
            </form>
        @endforeach
    </div>
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

        var add_to_cart = (id) => {
            var formData = $(`#form_product_${id}`).serialize();
            $.ajax({
                url: baseUrl + "/cart",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (data) {
                    alert(data['message']);
                    $(`#form_product_${id}`).trigger('reset');
                    $('#cart-number').html(data['cartCount']);
                },
                error: function (data) {
                    alert("Có lỗi xảy ra...", "error");
                }
            });
        }
    </script>
@endpush