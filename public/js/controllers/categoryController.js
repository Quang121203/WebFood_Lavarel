var oTable;

var getData = function (resetPaging) {
    if ($.fn.DataTable.isDataTable("#tbl_category")) {
        oTable.ajax.reload(null, resetPaging);
    } else {
        oTable = $("#tbl_category").DataTable({
            ajax: {
                type: "GET",
                dataType: "json",
                url: baseUrlAdmin + "/category/getList",
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
getData();

var openModalCrud = function (id) {
    loadingShow();
    var txt = id > 0 ? "UPDATE" : "ADD";
    $("#modal-header").html(txt);
    var url = baseUrlAdmin + "/category/" + id + "/edit";
    $.get(url, function (data) {
        loadingHide();
        $("#crud-modal-size-small").modal("show");
        if (id > 0) {
            $('#id').val(data.id);
            $('#name').val(data.name);
            $("#preview").attr("src", baseUrl + "/storage/categories/" + data.img);
            $("#btnDeleteImg").attr("disabled", false);
            $("#img").val(data.img);
        } else {
            $("#id").val("");
            $("#form_category").trigger("reset");
            $("#btnDeleteImg").attr("disabled", true);
            $("#preview").attr("src", '/images/no-image.png');
            $("#avarta").val(null);
            $("#img").val(null);
        }
    });
};


var save = function () {
    var formData = new FormData($("#form_category")[0]);
    $.ajax({
        url: baseUrlAdmin + "/category",
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
                $("#form_category").trigger("reset");
                getData(false);
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
        url: baseUrlAdmin + "/category/" + id,
        success: function (data) {
            loadingHide();
            toast(data.msg, data.success);
            getData();
        },
        error: function (data) {
            alert("Có lỗi xảy ra...", "error");
        },
    });
};
