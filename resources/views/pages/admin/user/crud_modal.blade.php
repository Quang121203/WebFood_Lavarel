<div class="modal fade" id="crud-modal-size-small" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-header" class="modal-title">CHỈNH SỬA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false;" id="form_user">
                    @csrf
                    <input type="hidden" class="form-control" id='id' name="id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" id='email' name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" id='password' name="password"
                                    placeholder="Password">
                                <small class="form-hint">Nếu không nhập, mật khẩu mặc định sẽ là 123456</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id='name' name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Role</label>
                                <select class="form-control" name="role_id" id="role_id">

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" id='address' name="address"
                                    placeholder="Address">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <input type="number" min="0" maxlength="11" class="form-control" id='phone' name="phone" placeholder="Phone">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">
                    Hủy
                </a>
                <button id="btnSave" onclick="save()" class="btn btn-primary">
                    Lưu</button>
            </div>
        </div>
    </div>
</div>