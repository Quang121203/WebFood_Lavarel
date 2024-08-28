@extends('layouts.master')

@section('content')
<section class="form-container">
    <form onsubmit="return false;" id="form_login">
        <h3>login now</h3>
        <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="255"
            oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="password" required placeholder="enter your password" class="box" maxlength="255"
            oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="login now" name="submit" class="btn" onclick="login()">
        <p>don't have an account? <a href="/register">register now</a></p>
    </form>
</section>
@endsection

@push('my_script')
    <script>
        var login = () => {
            var formData = $("#form_login").serialize();
            $.ajax({
                url: baseUrl + "/login",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (data) {
                    toast(data['msg'], data['success']);
                    if (data['success']) {
                        $(`#form_login`).trigger('reset');
                        window.location.href = baseUrl + '/';
                    }
                },
                error: function (data) {
                    alert("Có lỗi xảy ra...", "error");
                }
            });
        }
    </script>
@endpush