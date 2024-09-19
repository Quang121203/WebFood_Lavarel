<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-2.1.4/sl-2.0.5/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1000000;
        background-color: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loader img {
        height: 25rem;
    }


    table {
        margin-top: 1rem;
        margin-bottom: 1rem !important;
    }
</style>

<body class="sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        @include('components.admin.header')
        @include('components.admin.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('components.admin.footer')
        <div class="loader">
            <img src="{{asset('images/loader.gif')}}" alt="">
        </div>
    </div>

</body>

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<!-- bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
    integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
    crossorigin="anonymous"></script>
<!-- toast -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- adminlte -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- data Table -->
<script src="https://cdn.datatables.net/v/bs4/dt-2.1.4/sl-2.0.5/datatables.min.js"></script>
<!-- ckeditor -->
<script src="{{ asset('lib/ckeditor4.18.0/ckeditor.js') }}"></script>
<script src="{{ asset('lib/ckfinder/ckfinder.js') }}"></script>
<!-- moment -->
<script src="{{ asset('lib/moment/moment.js') }}"></script>

<script src="{{ asset('js/global.js?v=' . time()) }}"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function (xhr) {
            console.log(xhr);
            if (xhr.status === 401) {
                // Chuyển hướng đến trang login nếu gặp lỗi 401
                window.location.href = '/login';
            } else if (xhr.status === 403) {
                // Hiển thị thông báo lỗi cho mã lỗi 403
                alert("Bạn không có quyền thực hiện hành động này.");
            } else {
                alert("Có lỗi xảy ra...", "error");
            }
        }
    });

    var url = window.location;

    // for sidebar menu 
    $('ul.nav-treeview a').filter(function () {
        return this.href == url;
    }).css({ 'background-color': 'rgba(255, 255, 255, .1)', 'color': '#fff' })
        .parentsUntil(".nav-sidebar > .nav-treeview")
        .css({ 'display': 'block' })
        .addClass('menu-open')
</script>
@stack('my_script')

</html>