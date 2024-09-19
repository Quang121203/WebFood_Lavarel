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
                <form onsubmit="return false;" id="form_role">
                    @csrf
                    <input type="hidden" class="form-control" id='id' name="id">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id='name' name="name" placeholder="Name">
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