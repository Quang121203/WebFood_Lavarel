<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>
</body>

<!-- swiper==================================== -->
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

<script>
    const baseUrl = window.location.origin;
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

    function loader() {
        $('.loader').css('display', 'none');
    }

    function fadeOut() {
        setInterval(loader, 500);
    }

    window.onload = fadeOut;

    $('input[type="number"]').on('input', function () {
        var maxLength = $(this).attr('maxlength');
        if (maxLength && $(this).val().length > maxLength) {
            $(this).val($(this).val().slice(0, maxLength));
        }
    });
</script>
@stack('my_script')

</html>