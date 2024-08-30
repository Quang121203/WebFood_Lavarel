var oTable;

var getDataRole = () => {
    var url = baseUrlAdmin + "/role/getList";
    $.get(url, function (data) {
        $('#combobox').empty();
        $('#combobox').append($('<option>', {
            value: 0,
            text: "Role"
        }));
        $.each(data, function (index, item) {
            $('#combobox').append($('<option>', {
                value: item.id,
                text: item.name
            }));
            $('#role_id').append($('<option>', {
                value: item.id,
                text: item.name
            }));
        });
    });
}
getDataRole();

var getData = function (resetPaging, role_id, isActive) {
    if ($.fn.DataTable.isDataTable("#tbl_user")) {
        oTable.ajax.url(baseUrlAdmin + "/user/getList/" + role_id + "/" + isActive).load(null, resetPaging);
    } else {
        oTable = $("#tbl_user").DataTable({
            ajax: {
                type: "GET",
                dataType: "json",
                url: baseUrlAdmin + "/user/getList/" + role_id + "/" + isActive,
                dataSrc: "",
            },
            columns: [
                {
                    data: null,
                    class: "text-center text-sm",
                    render: function (data, type, full, meta) {
                        return meta.row + 1;
                    },
                    width: "8%",
                },
                {
                    class: "text-sm",
                    data: "name",
                    render: $.fn.dataTable.render.text()
                },
                {
                    class: "text-sm",
                    data: "email",
                    render: $.fn.dataTable.render.text()
                },
                {
                    class: "text-sm",
                    data: "phone",
                    render: $.fn.dataTable.render.text()
                },
                {
                    class: "text-sm",
                    data: "address",
                    render: $.fn.dataTable.render.text()
                },
                {
                    class: "text-sm",
                    data: "role_name",
                    render: $.fn.dataTable.render.text()
                },
                {
                    data: function (data, type, full, meta) {
                        if (data.is_online) {
                            return "";
                        }
                        else {
                            return (
                                ' <button type="button" onclick="openModalCrud(' +
                                data.id +
                                ')" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-edit"></i></button>' +
                                '<button type="button" onclick="openModalConfirmDelete(' +
                                data.id +
                                ')" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fa fa-trash"></i></button>'
                            );
                        }
                    },
                    class: "text-center",
                    width: "8%",
                },
            ],
            lengthMenu: [[5, 10, 20, 50, -1], [5, 10, 20, 50, "Tất cả"]],
            processing: true,
            ordering: true,
            select: true
        });
    }
};
getData(false, 0, 1);

var changeRole = () => {
    getData(false, $('#combobox').val(),$('#comboboxActive').val());
}

var changeActive = () => {
    getData(false, $('#combobox').val(),$('#comboboxActive').val());
}

var openModalCrud = function (id) {
    loadingShow();
    var txt = id > 0 ? "UPDATE" : "ADD";
    $("#modal-header").html(txt);
    var url = baseUrlAdmin + "/user/" + id + "/edit";
    $.get(url, function (data) {
        loadingHide();
        $("#crud-modal-size-small").modal("show");
        if (id > 0) {
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#phone').val(data.phone);
            $('#address').val(data.address);
            $('#role_id').val(data.role_id);

            $('#email').attr('readonly', true);
            $('#password').attr('readonly', true);
        } else {
            $("#id").val("");
            $("#form_user").trigger("reset");
            $('#email').attr('readonly', false);
            $('#password').attr('readonly', false);
        }
    });
};


var save = function () {
    var formData = new FormData($("#form_user")[0]);
    $.ajax({
        url: baseUrlAdmin + "/user",
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
            toast(data.msg, data.success);
            if (data.success) {
                $("#crud-modal-size-small").modal("hide");
                $("#form_user").trigger("reset");
                getData(false, $('#combobox').val(),$('#comboboxActive').val());
            }
        },
        error: function (data) {
            alert("Có lỗi xảy ra...", "error");
        },
        complete: function () {
            loadingHide();
        }
    });
};

var openModalConfirmDelete = function (id) {
    Swal.fire({
        title: "Xóa bản ghi ?",
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

var confirmDelete = function (id) {
    loadingShow();
    $.ajax({
        type: "DELETE",
        url: baseUrlAdmin + "/user/" + id,
        success: function (data) {
            loadingHide();
            toast(data.msg, data.success);
            getData(false, $('#combobox').val(),$('#comboboxActive').val());
        },
        error: function (data) {
            alert("Có lỗi xảy ra...", "error");
        },
    });
};
