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
                        const colors = ['red', 'black', '#fed330', '#00CC00'];
                        const statuses = ['canceled', 'pending', 'confirmed', 'complete'];
                        const color = colors[data];
                        const status = statuses[data];
                        return `<span style="color: ${color}">${status}</span>`;
                    }
                },
                {
                    class: "text-sm",
                    data: "created_at",
                    render: function (data, type, full, meta) {
                        return (moment(data).fromNow());
                    }
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
            $('#button-order').empty();
            if (id > 0) {
                data.detail.map((item, index) => {
                    $('#detail_order').append(`<tr>
                            <th scope="row">${index + 1}</th>
                            <td>${item.product_name}</td>
                            <td>${item.quanlity}</td>
                            <td>${item.price}</td>
                            <td>${item.total}</td>
                        </tr>`);
                })
                $('#detail_order').append(`<tr>
                    <th scope="row"></th>
                    <td><b>SUM</b></td>
                    <td></td>
                    <td></td>
                    <td><b>${data.order.total}</b></td>
                </tr>`);
                if (+data.order.status === 1) {
                    $('#button-order').append(`<button type="button" onclick="openModalConfirm(${data.order.id}
                                ,true)" class="btn btn-primary waves-effect waves-light">
                               Confỉrmed</button>
                                <button type="button" onclick="openModalConfirm(${data.order.id}
                                ,false)" class="btn btn-danger waves-effect waves-light mx-2">Cancel</button>`)
                }

                if (+data.order.status === 2) {
                    $('#button-order').append(`<button type="button" onclick="openModalConfirm(${data.order.id}
                                ,true)" class="btn btn-primary waves-effect waves-light">
                               Complete</button>
                                <button type="button" onclick="openModalConfirm(${data.order.id}
                                ,false)" class="btn btn-danger waves-effect waves-light mx-2">Cancel</button>`)
                }

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