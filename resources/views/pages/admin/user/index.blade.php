@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User</h1>
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
                        tabindex="-1" onchange="changeRole()">
                    </select>
                    <select class="form-control select select-hidden-accessible col-2 mx-2" id="comboboxActive"
                        name="comboboxActive" tabindex="-1" onchange="changeActive()">
                        <option value="1">Active</option>
                        <option value="0">Not active</option>
                    </select>
                    <div class="col-md-7">
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
                    <table style="width:100%" id="tbl_user" class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10px">STT</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.admin.user.crud_modal')
@endsection

@push('my_script')
    <script src="{{ asset('js/controllers/userController.js?v=' . time()) }}"></script>
@endpush