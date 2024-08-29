@extends('layouts.master')
<style>
    .box {
        position: relative;
    }

    .fa-times {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background-color: var(--red);
        color: var(--white);
        border: var(--border);
        line-height: 4rem;
        height: 4.3rem;
        width: 4.5rem;
        cursor: pointer;
        font-size: 2rem;
    }

    .fa-times:hover {
        background-color: var(--black);
        color: var(--white);
    }
</style>
@section('content')
<div class="heading">
    <h3>orders</h3>
</div>

<section class="orders">
    <h1 class="title">your orders</h1>
    <div class="box-container">
        @if(count($orders)>0)
            @foreach($orders as $order)
                @php
                    $date = new DateTime($order['created_at']);
                    $formattedDate = $date->format('d-m-Y');
                @endphp

                <div class="box">
                    @if ($order['status'] == 1)
                        <button class="fas fa-times" onclick="openModalConfirm({{$order['id']}})"
                            id="{{'order_button_' . $order['id']}}"></button>
                    @endif
                    <p>placed on : <span>{{$formattedDate}}</span></p>
                    <p>name : <span>{{$order['name']}}</span></p>
                    <p>email : <span>{{$order['email']}}</span></p>
                    <p>phone : <span>{{$order['phone']}}</span></p>
                    <p>address : <span>{{$order['address']}}</span></p>
                    <p>your orders :
                        @foreach($order['product'] as $index => $product)
                            <span>
                                {{ $product['name'] }} ({{ $product['quanlity'] }})
                                @if($index < count($order['product']) - 1)
                                    -
                                @endif
                            </span>
                        @endforeach
                    </p>
                    <p>total price :{{$order['total']}} <span>VND</span></p>
                    <p>payment status :
                        <span style="color: {{['red', 'black','#fed330','#00CC00'][$order['status']]}}"
                            id="{{'order_status_' . $order['id']}}">
                            {{ ['Canceled', 'Pending', 'Confirmed','Complete'][$order['status']] }}
                        </span>
                    </p>
                </div>
            @endforeach
        @else
            <p class="empty">no orders placed yet!</p>
        @endif
    </div>
</section>
@endsection

@push('my_script')
    <script>
        var openModalConfirm = function (id) {
            Swal.fire({
                title: "Xóa đơn hàng ?",
                text: "Lưu ý: không thể khôi phục",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Xác nhận",
                cancelButtonText: "Hủy bỏ",
            }).then((result) => {
                if (result.value) {
                    confirmDelete(id);
                }
            });
        };

        var confirmDelete = (id) => {
            loadingShow();
            $.ajax({
                type: "DELETE",
                url: baseUrlAdmin + "/order/" + id,
                success: function (data) {
                    loadingHide();
                    toast(data.msg, data.success);
                    $(`#order_status_${id}`).html("Order cancel");
                    $(`#order_status_${id}`).css('color', 'red');
                    $(`#order_button_${id}`).css('display', 'none');
                },
                error: function (data) {
                    alert("Có lỗi xảy ra...", "error");
                },
            });
        }
    </script>
@endpush