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
    @include('components.header')
    @yield('content')
    @include('components.footer')

    <div class="loader">
        <img src="{{asset('images/loader.gif')}}" alt="">
    </div>
</body>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<!-- UI -->
<script>
    const toast = (text, type) => {
        background = type ? "linear-gradient(to right, #00b09b, #96c93d)" : "#b71c1c";
        Toastify({
            node: (() => {
                const div = document.createElement("div");
                div.innerHTML = text;
                return div;
            })(),
            duration: 3000,
            gravity: "top", // `top` or `bottom`
            position: "left", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background,
            }
        }).showToast();
    }

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
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
</script>
<!-- logic -->
<script>
    const baseUrl = window.location.origin;
    var add_to_cart = (id) => {
        var formData = $(`#form_product_${id}`).serialize();
        $.ajax({
            url: baseUrl + "/cart",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (data) {
                toast(data['message'], data['success']);
                if (data['success']) {
                    $('#cart-number').html(data['cartCount']);
                }
                $(`#form_product_${id}`).trigger('reset');
            },
            error: function (data) {
                alert("Có lỗi xảy ra...", "error");
            }
        });
    }
</script>
@stack('my_script')

</html>