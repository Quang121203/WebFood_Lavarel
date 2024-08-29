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
        @if(count($cart) > 0)
            @foreach($cart as $item)
                <div class="box" id="{{'cart_' . $item['id']}}">
                    <a class="fas fa-eye"></a>
                    <button class="fas fa-times" onclick="cartDelete({{$item['id']}})"></button>
                    <img alt="{{$item['product']['name']}}" src="{{asset('storage/products/' . $item['product']['img'])}}">
                    <div class="name">{{$item['product']['name']}}</div>
                    <div class="flex">
                        <div class="price" id="item_price">{{$item['product']['price']}}<span>VND</span></div>
                        <input type="number" name="quanlity" class="number" min="1" max="99" maxlength="2"
                            value="{{$item['quanlity']}}" onchange="changeNumber(event,{{$item['product']['id']}})">
                    </div>
                    <div class="sub-total"> sub total :
                        <span id="{{'item_total_' . $item['product']['id']}}">{{$item['price']}} VND</span>
                    </div>
                </div>
                @php
                    $total += $item['price']
                @endphp
            @endforeach
        @else
            <p class="empty">your cart is empty</p>
        @endif
    </div>

    <div class="cart-total">
        <p>cart total : <span id="cart_total">{{$total}} VND</span></p>
        <a href="/check-out" class="btn {{count($cart) > 0 ? '' : 'disabled'}}" id="btnBuy">buy</a>
    </div>

    <div class="more-btn">
        <a href="/menu" class="btn">continue shopping</a>
    </div>
</section>
@endsection

@push('my_script')
    <script>
        var changeNumber = (event, product_id) => {
            var quanlity = event.target.value;
            $.ajax({
                url: baseUrl + "/cart/" + product_id,
                type: "PUT",
                data: {
                    quanlity
                },
                dataType: "json",
                success: function (data) {
                    $('#cart-number').html(data['total']['totalNumber']);
                    $("#item_total_" + product_id).html(data['price'] + " VND");
                    $("#cart_total").html(data['total']['totalPrice'] + " VND");
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
                success: function (data) {
                    toast(data['msg'], data['success']);
                    $('#cart_' + id).hide();
                    $('#cart-number').html(data['total']['totalNumber']);
                    $("#cart_total").html(data['total']['totalPrice'] + " VND");
                    if (data['total']['totalNumber'] == 0) {
                        $('#btnBuy').addClass("disabled");
                    }
                    else {
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