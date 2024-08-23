<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
<script src="{{ asset('js/global.js?v=' . time()) }}"></script>

<script>
    var $navbar = $('.header .flex .navbar');

    $('#menu-btn').click(function () {
        $navbar.toggleClass('active');
    });

    $(window).scroll(function () {
        $navbar.removeClass('active');
    });
</script>

@stack('my_script')

</html>