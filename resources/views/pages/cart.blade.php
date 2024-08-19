@extends('layouts.master')
@section('content')
<div class="heading">
    <h3>shopping cart</h3>
</div>

<section class="products">
    <h1 class="title">your cart</h1>
    <div class="box-container">
        @php
            $total = 0;
        @endphp
        @if(session('cart'))
            @foreach(session('cart') as $item)
                <div class="box" id="{{'container_' . $item['id']}}">
                    <a class="fas fa-eye"></a>
                    <button class="fas fa-times" onclick="cartDelete({{$item['id']}})"></button>
                    <img alt="{{$item['name']}}" src="{{asset('storage/products/' . $item['img'])}}">
                    <div class="name">{{$item['name']}}</div>
                    <div class="flex">
                        <div class="price" id="item_price">{{$item['price']}}<span>VND</span></div>
                        <input type="number" name="number" class="number" min="1" max="99" maxlength="2"
                            value="{{$item['number']}}" onchange="changeNumber(event,{{$item['id']}},{{$item['price']}})">
                    </div>
                    <div class="sub-total"> sub total :
                        <span id="{{'item_total_' . $item['id']}}">{{$item['total']}} VND</span>
                    </div>
                </div>
                @php
                    $total += $item['total']
                @endphp
            @endforeach
        @else
            <p class="empty">your cart is empty</p>
        @endif
    </div>

    <div class="cart-total">
        <p>cart total : <span id="cart_total">{{$total}} VND</span></p>
        <a href="/check-out" class="btn" id="btnBuy">buy</a>
    </div>

    <div class="more-btn">
        <a href="/menu" class="btn">continue shopping</a>
    </div>
</section>
@endsection

@push('my_script')
    <script>
        var changeNumber = (event, id, price) => {
            var number = event.target.value;
            $.ajax({
                url: baseUrl + "/cart/" + id,
                type: "PUT",
                data: {
                    _token: '{{ csrf_token() }}',
                    number,
                    price
                },
                dataType: "json",
                success: function (data) {
                    $('#cart-number').html(data['cartCount']);
                    $("#item_total_" + id).html(price * number + " VND");
                    $("#cart_total").html(data['total'] + " VND");
                },
                error: function (data) {
                    alert("Có lỗi xảy ra...", "error");
                }
            });
        }

        var cartDelete = (id) => {
            $.ajax({
                url: baseUrl + "/cart/" + id,
                type: "DELETE",
                dataType: "json",
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    alert(data['messenger']);
                    $('#container_' + id).hide();
                    $('#cart-number').html(data['cartCount']);
                    $("#cart_total").html(data['total'] + " VND");
                    if (data['total'] == 0) {
                        $('#btnBuy').addClass("disabled");
                    }
                    else{
                        $('#btnBuy').removeClass("disabled");
                    }
                },
                error: function (data) {
                    alert("Có lỗi xảy ra...", "error");
                }
            });
        }
    </script>
@endpush