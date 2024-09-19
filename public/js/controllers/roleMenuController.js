oTable.on('select', function (e, dt, type, indexes) {
    loadingShow();
    if (type === 'row') {
        var data = oTable.rows(indexes).data();
        var role_id = data[0].id;
        $("#role_menus_tittle").text("Chức năng nhóm: " + data[0].name);
        $("#role_id").val(role_id);
        $.ajax({
            url: baseUrlAdmin + "/roleMenu/getList/" + role_id,
            method: 'GET',
            dataType: 'json',
            success: function (d) {
                let html = ' <div class="checkbox-tree">';
                d.map((item) => {
                    html += `<label> ${item.name}</label>  <ul>`;
                    item.submenu.map((itemsub) => {
                        if (itemsub.check) {
                            html += `<div><input type="checkbox" name="${itemsub.id}" checked> ${itemsub.name}</div>`;
                        }
                        else {
                            html += `<div><input type="checkbox" name="${itemsub.id}"> ${itemsub.name}</div>`;
                        }
                    })
                    html += '</ul>'
                })
                html += '</div>';

                $('#menu-tree-container').html(html);
                loadingHide();
            }
        });
    }
});

var saveRoleMenus = () => {
    const role_id = $('#role_id').val();
    if (role_id) {
        loadingShow();
        var formData = $("#form_role_menus").serialize();

        $.ajax({
            url: baseUrlAdmin + "/roleMenu",
            type: "POST",
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
    else {
        toast("You have not chosen a role yet",false);
    }
}