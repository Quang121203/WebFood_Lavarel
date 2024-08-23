@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Category</h1>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="float-right btn btn-success waves-effect waves-light"
                            onclick="openModalCrud(0)">
                            <i class="fa fa-plus"></i>
                            Add
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="width:100%" id="tbl_category" class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10px">STT</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.admin.category.crud_modal')
@endsection

@push('my_script')
    <script src="{{ asset('js/controllers/categoryController.js?v=' . time()) }}"></script>
@endpush