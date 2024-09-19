const save = () => {
    var formData = new FormData($("#form_profile")[0]);
    $.ajax({
        url: baseUrl + "/profile",
        type: "POST",
        cache: false,
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function () {
            loadingShow();
        },
        success: function (data) {
            if (data.success) {
                // $("#form_profile").trigger("reset");
                toast(data.msg, data.success);
                console.log(data.user);
                if (data.user.img) {
                    $('#avatar_header').attr("src", baseUrl + "/storage/users/" + data.user.img);
                }
                else {
                    $("#avatar_header").attr("src", '/images/noAvatar.png');
                }
                $('#user_name_header').html(data.user.name);
            }
        },
        error: function (data) {
            alert("Có lỗi xảy ra...", "error");
        },
        complete: function () {
            loadingHide();
        }
    });
}

const change_Password = () => {
    var formData = $("#change_password_form").serialize();
    console.log(formData);
    $.ajax({
        url: "/changePassword",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {
            toast(data.message,data.success);
            if (data.success) {
                // $('#modal-change-password').modal('hide');
                // $('#change_password_form').trigger("reset");
                // alertNotify("Đổi mật khẩu thành công", "success");
            }
            else {
                // alertNotify(data.message, typeAlert);
            }
        },
        error: function (data) {
            alertNotify("Có lỗi xảy ra...", 'error');
        }
    });
}