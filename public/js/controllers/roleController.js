var oTable;

var getDataRole = function (resetPaging) {
    if ($.fn.DataTable.isDataTable("#tbl_role")) {
        oTable.ajax.reload(null, resetPaging);
    } else {
        oTable = $("#tbl_role").DataTable({
            ajax: {
                type: "GET",
                dataType: "json",
                url: baseUrlAdmin + "/role/getList",
                dataSrc: "",
            },
            columns: [
                {
                    data: null,
                    width: "1%",
                    class: "text-center",
                    render: function (data, type, full, meta) {
                        return meta.row + 1;
                    },
                },
                {
                    data: "name",
                    render: $.fn.dataTable.render.text()
                },
                {
                    data: function (data, type, full, meta) {
                        return (
                            '<div class="btn-group w-100">' +
                            ' <button type="button" onclick="openModalCrud(' +
                            data.id +
                            ')" class="btn btn-outline-primary btn-pill btn-xs "><i class="fa fa-pencil"></i></button>' +
                            ' <button type="button" onclick="openModalConfirmDelete(' +
                            data.id +
                            ')" class="btn btn-outline-danger btn-pill btn-xs" ><i class="fa fa-trash"></i></button>' +
                            ' <button type="button" onclick="openModalListUser(' +
                            data.id +
                            ')" class="btn btn-outline-success btn-pill btn-xs"><i class="fa fa-users"></i></button>' +
                            "</div>"
                        );
                    },
                    width: "15%",
                    class: "text-center"
                },
            ],
            select: true,
            paging: true,
            searching: true,
            lengthChange: false,
            info: false,
            processing: true,
        });
       
    }
};
getDataRole();

var openModalCrud = function (id) {
    loadingShow();
    var txt = id > 0 ? "UPDATE" : "ADD";
    $("#modal-header").html(txt);
    if (id > 0) {
        var url = baseUrlAdmin + "/role/" + id + "/edit";
        $.get(url, function (data) {
            loadingHide();
            $("#crud-modal-size-small").modal("show");
            $("#id").val(data.id);
            $("#name").val(data.name);
        });
    } else {
        loadingHide();
        $("#id").val("");
        $("#form_role").trigger("reset");
        $("#crud-modal-size-small").modal("show");
    }
};

var save = function () {
    var formData = $("#form_role").serialize();
    $.ajax({
        url: baseUrlAdmin + "/role",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {
            toast(data.msg, data.success);
            if (data.success) {
                $("#crud-modal-size-small").modal("hide");
                $("#form_role").trigger("reset");
                getDataRole(false);
            }
        },
        error: function (data) {
            alert("Có lỗi xảy ra...", "error");
        },
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
        url: baseUrlAdmin + "/role/" + id,
        success: function (data) {
            loadingHide();
            toast(data.msg, data.success);
            getDataRole();
        },
        error: function (data) {
            alert("Có lỗi xảy ra...", "error");
        },
    });
};


