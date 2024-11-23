@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Role</h1>
            </div>
        </div>
    </div>
</div>

<div class="row col-12">
    <div class="col-md-6">
        <div class="col-md-12">
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
                        <table style="width:100%" id="tbl_role" class="table table-bordered table-sm">
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
    <div class="col-md-6">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex p-0">
                    <h3 class="card-title p-3" id="role_menus_tittle">Menu</h3>
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item ml-2">
                            <button onclick="saveRoleMenus()" type="button" class="btn btn-block bg-gradient-success">
                                <i class="fa fa-save"></i>
                                Save
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body" style="height: 400px; overflow-y: scroll;">
                    <form onsubmit="return false;" id="form_role_menus">
                        <input name="role_id" id="role_id" hidden/>
                        <div id="menu-tree-container">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.admin.role.crud_modal')
@include('pages.admin.role.list_role_user_modal')
@endsection

@push('my_script')
    <script src="{{ asset('js/controllers/roleController.js?v=' . time()) }}"></script>
    <script src="{{ asset('js/controllers/roleUserController.js?v=' . time()) }}"></script>
    <script src="{{ asset('js/controllers/roleMenuController.js?v=' . time()) }}"></script>
@endpush