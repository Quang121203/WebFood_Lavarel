const baseUrl = window.location.origin;
const baseUrlAdmin = window.location.origin + '/admin';
let user_current;
$.ajax({
    url: baseUrl + "/info",
    type: "GET",
    dataType: "json",
    success: function (data) {
        user_current = data;
    }
});


function loadingHide() {
    $('.loader').css('display', 'none');
}

function loadingShow() {
    $('.loader').css('display', 'flex');
}

function loading() {
    loadingShow()
    setInterval(loadingHide, 500);
}

window.onload = loading;

var getCountCart = () => {
    $.ajax({
        url: baseUrl + "/cart/getCount",
        type: "GET",
        dataType: "json",
        success: function (data) {
            $('#cart-number').html(data.totalNumber);
        },
        error: function (data) {
            alert("Có lỗi xảy ra...", "error");
        }
    });
}

getCountCart();

$('input[type="number"]').on('input', function () {
    var maxLength = $(this).attr('maxlength');
    if (maxLength && $(this).val().length > maxLength) {
        $(this).val($(this).val().slice(0, maxLength));
    }
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
});

var toast = function (text, type) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-start',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true
    });
    Toast.fire({
        icon: type ? "success" : "error",
        title: text
    });
}

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
            if (data.statusText == "Unauthorized") {
                window.location.href = '/login';
                return;
            }
            alert("Có lỗi xảy ra...", "error");
        }
    });
}

$("#preview").click(function () {
    $("#avatar").trigger("click");
});

var readURL = function (input) {
    if (input.files && input.files[0]) {
        var fileName = input.files[0].name;
        $("#img").val(fileName);
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#btnDeleteImg").attr("disabled", false);
            $('#preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

var deleteImg = function () {
    $("#img").val("");
    $("#preview").attr("src", '/images/no-image.png');
    $("#avatar").val(null);
    $("#btnDeleteImg").attr("disabled", true);
}

var logout = function () {
    $.ajax({
        url: baseUrl + "/logout",
        type: "POST",
        dataType: "json",
        success: function (data) {
            window.location.href = '/login';
        },
        error: function (data) {
            alert("Có lỗi xảy ra...", "error");
        }
    });
}