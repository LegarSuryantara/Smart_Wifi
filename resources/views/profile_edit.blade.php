@extends('layouts.app_1')

@section('title', 'Edit profile')

@section('content')
<div class="profile-card mt-5">
    <div class="d-flex align-items-center mb-4">
        <div class="profile-img rounded-circle bg-success text-white d-flex justify-content-center align-items-center position-relative" style="width: 100px; height: 100px;">
            N
            <a href="#" class="position-absolute" style="bottom: 0; right: 0;">
                <i class="fa fa-pencil text-white bg-dark rounded-circle p-1"></i>
            </a>
        </div>
        <div class="profile-info ml-3">
            <h2>Nogi</h2>
            <p>Nogi123@gmail.com</p>
        </div>
    </div>
    <form enctype="multipart/form-data" method="POST" action="{{ route('profile.update') }}">
        @csrf
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nama" name="name" value="Nogi">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label">Email account</label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="email" name="email" value="Nogi123@gmail.com">
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-sm-4 col-form-label">Nomor Telepon</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="phone" name="phone" value="01234567890">
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-sm-4 col-form-label">Alamat</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="address" name="address" value="Jawa Timur">
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>
@endsection