@extends('layouts.admin')
@section('content')
@php
$user =Auth::user();
@endphp
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline mt-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title mt-2 mb-1">Infomation</h3>
                            </div>
                            <div class="col-md-auto ml-auto ">
                                <a href="#" class="btn btn-success btn-block" data-toggle="modal"
                                    data-target="#modal-change-password"><i class="fa fa-retweet mr-2"
                                        aria-hidden="true"></i> <b>Change password</b></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body box-profile">
                        <form onsubmit="return false;" id="form_profile" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-3">
                                    <input type="hidden" name="id" value ="{{$user['id']}}">
                                        <div class=" card card-sm">
                                    <input onchange="readURL(this)" id="avatar" type="file" name="avatar"
                                        accept="image/*" style="display: none;">
                                    <input id="img" type="text" name="img" style="display: none;" value="{{ isset($user['img']) ? $user['img'] : null}}">
                                    <img style="cursor: pointer;"
                                        src="{{ isset($user['img']) ? asset('storage/users/'.$user['img'])  : asset('images/no-image.png') }}"
                                        id="preview" class="img-thumbnail" class="card-img-top">
                                    <button id="btnDeleteImg" onclick="deleteImg()" type="button"
                                    {{ isset($user['img']) ? '' : 'disabled' }}
                                        class="btn btn-danger btn-sm btn-block">
                                       Delete
                                    </button>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group mb-2 ">
                                    <label class="form-label required">Name</label>
                                    <div>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $user['name'] }}">
                                    </div>
                                </div>
                                <div class="form-group mb-2 ">
                                    <label class="form-label required">Address</label>
                                    <div>
                                        <input type="text" class="form-control" name="address" id="address" value="{{ $user['address'] }}">
                                    </div>
                                </div>
                                <div class="form-group mb-2 ">
                                    <label class="form-label required">Phone</label>
                                    <div>
                                        <input type="number" class="form-control" name="phone" id="phone" value="{{ $user['phone'] }}" maxlength="11">
                                    </div>
                                </div>
                                <div class="form-group mb-2 ">
                                    <label class="form-label required">Email</label>
                                    <div>
                                        <input readonly type="email" class="form-control"  value="{{ $user['email'] }}">
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-warning ">
                        <i class="fa fa-backward"></i> Back</a>
                    <button id="btn_save" onclick="save()" class="btn btn-primary float-right"><i
                            class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
@include('pages.modal_change_pass');
@push('my_script')
<script src="{{ asset('js/controllers/profileController.js?v=' . time()) }}"></script>
@endpush