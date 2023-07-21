@extends('layouts.adminLTE.template')

@section('title','List User ')
@section('header_title','User ')

@php
$dashboard = true;
@endphp

@section('header')
<style>
    .pointer {
        cursor: pointer;
    }
</style>
<div class="page-inner py-5 bg-dark">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>

            <h2 class="text-white pb-2 fw-bold">
                Menu User
            </h2>
            <!-- <h5 class="text-white op-7 mb-2">Selamat datang, <strong>{{ Auth::user()->nama ?? 'Guest' }}</strong></h5> -->
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt--2">
    <!-- Statistic -->
    <div class="col-md-12">
        <div class="card full-height">
            <div class="card-header">
                <div class="card-head-row">
                    
                    <div class="card-tools">
                        <button class="btn btn-danger  btn-round btn-sm" data-toggle="modal" data-target="#modal_user" onclick="tambah()">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            &emsp; Tambah Data
                        </button>
                        <!-- <a href="{{url('/user/create?role='.request()->segment(count(request()->segments())))}}" class="btn btn-danger  btn-round btn-sm tambah_user" data-toggle="modal" data-target="#modal_user">
                        </a> -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card full-height">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 p-2 float-right">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" value="" id="search" placeholder="cari">
                            <div class="input-group-append">
                                <button type="button" id="searchButton" class="btn btn-primary btn-sm" onClick="view()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    
                        <input type="hidden" name="kategori" id="kategori" value="">
                        <input type="hidden" name="user_role" id="user_role" value="{{Auth::user()->role}}">

                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-4 p-2 text-center">
                        <div class="mailbox-controls">
                            <div class="float-right">
                                <span id="displayPage">0-0/0</span>
                                <div class="btn-group" id="btnPaging1">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-head-bg-danger table-hover small">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col" style="text-align:center;" colspan="2">Nama</th>
                                        <th scope="col" style="text-align:center;">Alamat</th>
                                        <th scope="col" style="text-align:center;"></th>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mailbox-controls">
                            <div class="float-right">
                                <span id="displayPage2">0-0/0</span>
                                <div class="btn-group" id="btnPaging2">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================================== -->
<!-- Modal Create & Edit Data User      -->
<!-- ================================== -->
<div class="modal fade" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span class="title modal_title_user"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="margin:0px;">

                <form action="{{url('/api/user/create')}}" method="post" id="form_data">
                    @csrf
                            <div class="row">
                                <div class="col-md-12" id="insert_field1">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                             <label for="name">Foto</label>
                                        </div>
                                        <div class="form-group">
                                            <img id="blah" src="" alt="your image" style="max-width:100px;max-height:100px;" name="foto" />
                                            <input accept="image/*" type='file' id="imgInp" name="foto"/>
                                            <input type="hidden" value="" name="foto_lama">
                                            <input type="hidden" value="{{url('/image/default.jpg')}}" name="default_foto">

                                            <div class="foto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <div class="input-group">
                                                    <input autocomplete="off" type="text" class="form-control " id="name" value="" placeholder="Nama" name="name" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">
                                                            <i class="fas fa-user-circle "></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <div class="input-group">
                                                    <input autocomplete="off" type="email" class="form-control " id="email" value="" placeholder="Alamat Email" name="email" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">
                                                            <i class="flaticon-envelope"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control " id="password" value="{{old('password')}}" placeholder="Password" name="password">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">
                                                                <i class="fas fa-lock"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputpwd3">Confirm Password</label>
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control " id="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Confirm Password" data-validation-match-match="password" name="password_confirmation">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">
                                                                <i class="fas fa-lock"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea class="form-control" name="alamat" id="alamat" rows="5"></textarea>
                                                <div class="alamat">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <input type="hidden" name="id" id="id_nilai" value="">
                    <input type="hidden" name="redirect" value="{{url('/user')}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button class="btn btn-primary">Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ================================== -->
<!-- End Modal Create & Edit Data User  -->
<!-- ================================== -->
@endsection
@section('js')

<script src="{{asset('js/hapus.js')}}"></script>
<script src="{{asset('js/index/user/app.js')}}"></script>
<script src="{{asset('js/submitForm.js')}}"></script>
@endsection
@push('bottom')

@endpush