<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('components.home.header')
    @yield('content')
    @include('components.home.footer')

    <div class="loader">
        <img src="{{asset('images/loader.gif')}}" alt="">
    </div>
</body>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script src="{{ asset('js/global.js?v=' . time()) }}"></script>

<script>
    var $navbar = $('.header .flex .navbar');
    var $profile = $('.header .flex .profile');

    $('#menu-btn').click(function () {
        $navbar.toggleClass('active');
        $profile.removeClass('active');
    });

    $('#user-btn').click(function () {
        $profile.toggleClass('active');
        $navbar.removeClass('active');
    });

    $(window).scroll(function () {
        $navbar.removeClass('active');
        $profile.removeClass('active');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function (xhr) {
            if (xhr.status === 401) {
                window.location.href = '/login';
            } else if (xhr.status === 403) {
                alert("Bạn không có quyền thực hiện hành động này.");
            } else {
                alert("Có lỗi xảy ra...", "error");
            }
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        var stepper = new Stepper(document.querySelector(".bs-stepper"), {
            linear: true,
            animation: true
        })
        window.stepper = stepper
    })
</script>

@stack('my_script')

</html>