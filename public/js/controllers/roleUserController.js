var uTable;
var getDataRoleUser = function (resetPaging, role_id) {
    if ($.fn.DataTable.isDataTable("#tbl_role_users")) {
        uTable.ajax.url(baseUrlAdmin + "/role/getRoleUser/" + role_id ).load(null, resetPaging);
    } else {
        uTable = $("#tbl_role_users").DataTable({
            ajax: {
                type: "GET",
                dataType: "json",
                url: baseUrlAdmin + "/role/getRoleUser/" + role_id ,
                dataSrc: "",
            },
            "columns": [
                {
                    "data": function (data, type, full, meta) {
                        var checked = data.check > 0 ? "checked" : "";
                        return '<input name="' + data.id + '" class="m-0 align-middle checkbox" type="checkbox"' + checked + '>';
                    },
                    "class": "text-center"
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function (data, type, full, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": "name",
                    render: $.fn.dataTable.render.text()
                },
                {
                    "data": "email",
                    render: $.fn.dataTable.render.text()
                },
            ],

            lengthMenu: [[5, 10, 20, 50, -1], [5, 10, 20, 50, "Tất cả"]],
            processing: true,
            select: true
        });
    }
};

var openModalListUser = function (role_id) {
    loadingShow();
    $("#list-modal-size-normal").modal("show");
    $("#role_id").val(role_id);
    getDataRoleUser(true,role_id);
    loadingHide();
};

var saveRoleUsers = function () {
    loadingShow();
    var formData = $("#form_role_user").serialize();
    $.ajax({
        url: baseUrlAdmin+"/user/0",
        type: "PUT",
        data: formData,
        dataType: "json",
        success: function (data) {
            loadingHide();
            toast(data.msg, data.success);
            if (data.success) {
                $("#list-modal-size-normal").modal("hide");
                $("#form_role_user").trigger("reset");
            }
        },
        error: function (data) {
            alert("Có lỗi xảy ra...", "error");
        },
    });
}