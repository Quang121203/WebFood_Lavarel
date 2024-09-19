{{-- MODAL Change password --}}
<div class="modal fade" id="modal-change-password" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CHANGE PASSWORD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false;" id="change_password_form" method="POST">
                    @csrf
                    <div class="form-group mb-2 row">
                        <label class="form-label col-6 col-form-label">Mật khẩu hiện tại <span
                                class="text-danger">*</span> </label>
                        <div class="col">
                            <input data-toggle="password"  type="password" id="password" name="current_password"
                                autocomplete="current_password" class="form-control" aria-describedby="emailHelp"
                                placeholder="Mật khẩu hiện tại">
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="form-label col-6 col-form-label">Mật khẩu mới <span
                                class="text-danger">*</span></label>
                        <div class="col">
                            <input data-toggle="password" type="password" id="new_password" class="form-control" name="new_password"
                                autocomplete="current-password" placeholder="Mật khẩu mới">
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="form-label col-6 col-form-label">Xác nhận mật khẩu mới <span
                                class="text-danger">*</span></label>
                        <div class="col">
                            <input data-toggle="password" type="password" id="new_confirm_password" class="form-control"
                                name="new_confirm_password" autocomplete="current-password"
                                placeholder="Xác nhận mật khẩu mới">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-dismiss="modal">Đóng</button>
                <button onclick="change_Password()" id="btnChangePassword" type="button" class="btn btn-primary">Cập
                    nhật</button>
            </div>
        </div>
    </div>
</div>
