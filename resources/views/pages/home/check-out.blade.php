@extends('layouts.master')

@section('content')
<style>
    input:focus {
        border: 3px solid var(--yellow);
    }

    p {
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
            @if(session('cart'))
                    @foreach(session('cart') as $item)
                            <p>
                                <span class="name">{{$item['name']}}</span>
                                <span class="price"> {{$item['price']}} VND x {{$item['number']}}</span>
                            </p>
                            @php
                                $total += $item['total']
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
            <p><i class="fas fa-user"></i><input placeholder="name" name="name" required /></p>
            <p><i class="fas fa-phone"></i><input placeholder="phone" name="phone" required type="number"
                    maxlength="11" /></p>
            <p><i class="fas fa-envelope"></i><input placeholder="email" name="email" required /></p>
            <p><i class="fas fa-map-marker-alt"></i><input placeholder="address" name="address" required /></p>
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
                    else{
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