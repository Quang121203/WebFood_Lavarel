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
        <div class="name">{{$product->store == 0 ? "Sold out" : "Store: " . $product->store}}</div>
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

<div class="review">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 class="review-title">Đánh giá sản phẩm</h1>
        <div class="star-rating">
            AVG: 
            @for ($i = 1; $i <= 5; $i++)
                <i class="fas fa-star {{ $i <= $rate_avg ? 'checked' : '' }}"></i>
            @endfor
        </div>
    </div>


    @if(Auth::check())
        @if (!$hasPurchased)
            <div class="alert alert-warning">
                Bạn cần mua sản phẩm để có thể đánh giá và bình luận.
            </div>
        @else
            <div class="star-rating rate">
                <i class="fas fa-star" data-value="1"></i>
                <i class="fas fa-star" data-value="2"></i>
                <i class="fas fa-star" data-value="3"></i>
                <i class="fas fa-star" data-value="4"></i>
                <i class="fas fa-star" data-value="5"></i>
            </div>

            <div class="comment-box">
                <textarea id="userComment" placeholder="Viết đánh giá của bạn..." rows="4"></textarea>
                <button id="submitReview" class="btn" onclick="submit({{$product['id']}})">Submit a review</button>
            </div>
        @endif
    @else
        <p class="login-prompt">Please <a href="{{ route('login') }}">log in</a> to rate the product.</p>
    @endif

    <div class="all-reviews">
        <div id="all-comments" ">
            @foreach ($comments as $comment)
                                                                <div class=" review-card">
                    <img src="{{ $comment['user']['img'] ? asset('storage/users/' .  $comment['user']['img']) : asset('images/noAvatar.png') }}"
                        alt="User Image" class="user-image">

                    <div class="review-info">
                        <div>
                            <p class="user-name">{{ $comment->user->name }}</p>
                            <p class="user-date">{{ $comment->created_at->format('d/m/Y - H:i:s') }}</p>
                            <p class="user-comment">{{ $comment->content }}</p>
                        </div>

                        <div class="star-rating static">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $comment->rate ? 'checked' : '' }}"></i>
                            @endfor
                        </div>

                    </div>

                </div>
            @endforeach
    </div>
</div>
</div>

@endsection

@push('my_script')
    <script>
        const stars = document.querySelectorAll('.rate i');
        
        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const value = parseInt(this.getAttribute('data-value'));
                if (value === selectedRating) {
                    selectedRating = 0;
                    stars.forEach(s => s.classList.remove('checked'));
                } else {
                    selectedRating = value;
                    stars.forEach(s => {
                        if (parseInt(s.getAttribute('data-value')) <= value) {
                            s.classList.add('checked');
                        } else {
                            s.classList.remove('checked');
                        }
                    });
                }
            });
        });

        const submit = (product_id) => {
            const comment = document.getElementById('userComment').value;
            if (selectedRating === 0) {
                toast('Please select number of stars before submitting', false);
            }
            else if (comment.trim() == "") {
                toast('Please fill comment before submitting', false);
            }
            else {
               
                const data = {
                    product_id: product_id,
                    rate: selectedRating,
                    content: comment
                }

                $.ajax({
                    url: baseUrl + "/comment",
                    type: "POST",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        selectedRating = 0;
                        document.getElementById('userComment').value = "";
                        stars.forEach(s => {
                            s.classList.remove('checked');
                        });
                        window.location.reload();
                    },
                    error: function (data) {
                        alert("Có lỗi xảy ra...", "error");
                    }
                });
            }
        };

    </script>
@endpush