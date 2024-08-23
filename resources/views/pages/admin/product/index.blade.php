@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Product</h1>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <select class="form-control select select-hidden-accessible col-2" id="combobox" name="combobox"
                        tabindex="-1" aria-hidden="true" onchange="changeCategory()">
                    </select>
                    <div class="col-md-10">
                        <button type="button" onclick="openModalCrud(0)"
                            class="float-right btn btn-success waves-effect waves-light">
                            <i class="fa fa-plus"></i>
                            Add
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="width:100%" id="tbl_product" class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10px">STT</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Purchased</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.admin.product.crud_modal')
@endsection

@push('my_script')
    <script>
        var editor = CKEDITOR.replace('ckeditor4');
        CKFinder.setupCKEditor(editor);

        editor.on('change', function (evt) {
            $("#content").val(evt.editor.getData());
        });
        editor.config.height = 200;
    </script>
    <script src="{{ asset('js/controllers/productController.js?v=' . time()) }}"></script>
@endpush