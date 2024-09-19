<div class="modal fade" id="list-modal-size-normal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-header" class="modal-title">List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false;" id="form_role_user">
                    <input type="hidden" name="role_id" id="role_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table style="width:100%" id="tbl_role_users" class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center"># </th>
                                            <th class="text-center">STT</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSaveRoleUsers" onclick="saveRoleUsers()" class="btn btn-success">
                    <i class="fa fa-save"></i>
                    Lưu</button>
            </div>
        </div>
    </div>
</div>