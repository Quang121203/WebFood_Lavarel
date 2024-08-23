var oTable;
var getData = function (resetPaging, status) {
    if ($.fn.DataTable.isDataTable("#tbl_order")) {
        oTable.ajax.url(baseUrlAdmin + "/order/getList/" + status).load(null, resetPaging);
    } else {
        oTable = $("#tbl_order").DataTable({
            ajax: {
                type: "GET",
                dataType: "json",
                url: baseUrlAdmin + "/order/getList/" + status,
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
                    data: "phone",
                    render: $.fn.dataTable.render.text()
                },
                {
                    class: "text-sm",
                    data: "email",
                    render: $.fn.dataTable.render.text()
                },
                {
                    class: "text-sm",
                    data: "address",
                    render: $.fn.dataTable.render.text()
                },
                {
                    class: "text-sm",
                    data: "total",
                    render: $.fn.dataTable.render.text()
                },
                {
                    class: "text-sm",
                    data: "status",
                    render: function (data, type, full, meta) {
                        const colors = ['red', 'black', 'black', 'black', 'green'];
                        const statuses = ['canceled', 'pending', 'confirmed', 'in transit', 'received'];
                        const color = colors[data];
                        const status = statuses[data];
                        return `<span style="color: ${color}">${status}</span>`;
                    }
                },
                {
                    data: function (data, type, full, meta) {
                        var html = '';
                        if (data.is_online) {
                            return "";
                        }
                        else {
                            if (data.status < 4 && data.status != 0) {
                                html +=
                                    ' <button type="button" onclick="openModalConfirm(' +
                                    data.id +
                                    ',true)" class="btn btn-sm btn-primary waves-effect waves-light">' +
                                    ['canceled', 'pending', 'confirmed', 'in transit', 'received'][data.status + 1] +
                                    '</button>'
                            }
                            if (data.status == 1) {
                                html +=
                                    '<button type="button" onclick="openModalConfirm(' +
                                    data.id +
                                    ',false)" class="btn btn-sm btn-danger waves-effect waves-light mx-2">Cancel</button>'
                            }
                            return html;
                        }
                    },
                    class: "text-center",
                    width: "20%",
                },
            ],
            lengthMenu: [[5, 10, 20, 50, -1], [5, 10, 20, 50, "Tất cả"]],
            processing: true,
            ordering: true,
            select: true
        });
    }
};
getData(false, 1);

var changeStatus = () => {
    var status = $('#combobox').val();
    getData(false, status);
}

oTable.on('select', function (e, dt, type, indexes) {
    if (type === 'row') {
        var id = oTable.rows(indexes).data()[0].id;
        var url = baseUrlAdmin + "/order/" + id + "/edit";
        loadingShow();
        $.get(url, function (data) {
            loadingHide();
            $("#crud-modal-size-small").modal("show");
            $('#detail_order').empty();
            if (id > 0) {
                data.map((item, index) => {
                    $('#detail_order').append(`<tr>
                            <th scope="row">${index + 1}</th>
                            <td>${item.product_name}</td>
                            <td>${item.quantity}</td>
                            <td>${item.price}</td>
                            <td>${item.total}</td>
                        </tr>`);
                })
            };
        })
    }
});

var openModalConfirm = function (id, type) {
    $("#crud-modal-size-small").modal("hide");
    Swal.fire({
        title: type ? "Sửa đơn hàng?" : "Xóa đơn hàng ?",
        text: "Lưu ý: không thể khôi phục",
        icon: type ? "info" : "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xác nhận",
        cancelButtonText: "Hủy bỏ",
    }).then((result) => {
        $("#crud-modal-size-small").modal("hide");
        if (result.value) {
            if (type) {
                confirmUpdate(id);
            } else {
                confirmDelete(id);
            }

        }
    });
};

var confirmUpdate = (id) => {
    loadingShow();
    $.ajax({
        type: "PUT",
        url: baseUrlAdmin + "/order/" + id,
        success: function (data) {
            loadingHide();
            toast(data.msg, data.success);
            getData(false, $('#combobox').val());
        },
        error: function (data) {
            alert("Có lỗi xảy ra...", "error");
        },
    });
}

var confirmDelete = (id) => {
    loadingShow();
    $.ajax({
        type: "DELETE",
        url: baseUrlAdmin + "/order/" + id,
        success: function (data) {
            loadingHide();
            toast(data.msg, data.success);
            getData(false, $('#combobox').val());
        },
        error: function (data) {
            alert("Có lỗi xảy ra...", "error");
        },
    });
}