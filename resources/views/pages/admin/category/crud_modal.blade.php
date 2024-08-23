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
                <form onsubmit="return false;" id="form_category">
                    @csrf
                    <input type="hidden" class="form-control" id='id' name="id">
                    <div class="row d-flex justify-content-between">
                        <div class="col-2">
                            <div class="form-group d-flex flex-column align-items-center">
                                <label class="form-label">Image</label>
                                <input onchange="readURL(this)" id="avatar" type="file" name="avatar" accept="image/*"
                                    style="display: none;">
                                <input id="img" type="text" name="img" style="display: none;">
                                <img id="preview" style="height: 7rem;  max-width: 7rem;" alt="..." />
                                <button class="mt-2" id="btnDeleteImg" onclick="deleteImg()">
                                    <i class="fa fa-times"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id='name' name="name" placeholder="Name">
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