@extends('layouts.master')

@section('content')
<div class="heading">
    <h3>our menu</h3>
</div>
<section class="products">
    <h1 class="title">latest</h1>
    <div class="box-container">
        @foreach ($products as $product)
            <form onsubmit="return false;" id="{{'form_product_' . $product->id}}" class="box">
                @CSRF
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <a class="fas fa-eye"></a>
                <button type="submit" class="fas fa-shopping-cart" onclick="add_to_cart({{$product->id}})"></button>
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
</section>
@endsection

@push('my_script')
    <script>
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