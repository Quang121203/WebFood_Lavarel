@extends('layouts.master')

@section('content')
@php
    $user = Auth::user();
@endphp
<style>
    input:focus {
        border: 3px solid var(--yellow);
    }

    .user-info-input {
        display: flex;
        align-items: center;
    }

    i {
        flex: 1;
    }

    input {
        flex: 8;
    }
</style>
<div class="heading">
    <h3>checkout</h3>
</div>
<section class="checkout">
    <h1 class="title">order summary</h1>
    <form onsubmit="return false;" id="form_order">
        @CSRF
        <div class="cart-items">
            <h3>cart items</h3>
            @php
                $total = 0;
            @endphp
            @if(count($cart) > 0)
                    @foreach($cart as $item)
                            <p>
                                <span class="name">{{$item['product']['name']}}</span>
                                <span class="price"> {{$item['product']['price']}} VND x {{$item['quanlity']}}</span>
                            </p>
                            @php
                                $total += $item['price']
                            @endphp
                    @endforeach
            @else
                <p class="empty">your cart is empty</p>
            @endif

            <p class="grand-total"><span class="name">grand total :</span>
                <span class="price">{{$total}} VND</span>
            </p>
            <a href="/cart" class="btn">view cart</a>
        </div>

        <div class="user-info">
            <h3>your info</h3>
            <input name="total" hidden value="{{$total}}" />
            <input name="status" hidden value="1" />
            <p class="user-info-input"><i class="fas fa-user"></i><input placeholder="name" name="name" required value="{{$user->name}}"/></p>
            <p class="user-info-input"><i class="fas fa-phone"></i><input placeholder="phone" name="phone" required
                    type="number" maxlength="12" value="{{$user->phone}}"/></p>
            <p class="user-info-input"><i class="fas fa-envelope"></i><input placeholder="email" name="email"
                    required value="{{$user->email}}"/></p>
            <p class="user-info-input"><i class="fas fa-map-marker-alt"></i><input placeholder="address" name="address"
                    required value="{{$user->address}}"/></p>
            <select name="method" class="box">
                <option value="" disabled selected>select payment method --</option>
                <option value="cash on delivery">cash on delivery</option>
                <option value="credit card">credit card</option>
                <option value="paytm">paytm</option>
                <option value="paypal">paypal</option>
            </select>
            <button class="btn" style="width:100%; background:var(--red); color:var(--white);" onclick="order()">
                place order
            </button>
        </div>
    </form>
</section>
@endsection

@push('my_script')
    <script>
        var order = () => {
            var formData = $('#form_order').serialize();
            $.ajax({
                url: baseUrl + "/order",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (data) {
                    if (data.success) {
                        window.location.href = baseUrl + "/order";
                        $('#form_order').trigger('reset');
                    }
                    else {
                        toast(data.msg, data.success);
                    }
                },
                error: function (data) {
                    alert("Có lỗi xảy ra...", "error");
                }
            });
        }
    </script>
@endpush