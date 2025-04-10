@extends('layouts.app_1')

@section('title', 'profile')

@section('content')
<section class="pofile">
    <div class="profile-card mt-5">
        <div class="d-flex align-items-center mb-4">
            <div class="profile-img">N</div>
            <div class="profile-info">
                <h2>Nogi</h2>
                <p>Nogi123@gmail.com</p>
            </div>
            <a href="{{ route('profile.edit') }}" class="ml-auto edit-profile">Edit profile</a>
        </div>
        <form>
            <div class="form-group row">
                <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" readonly class="form-control-plaintext" id="nama" value=": Nogi">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email account</label>
                <div class="col-sm-8">
                    <input type="text" readonly class="form-control-plaintext" id="email" value=": Nogi123@gmail.com">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-4 col-form-label">Nomor Telepon</label>
                <div class="col-sm-8">
                    <input type="text" readonly class="form-control-plaintext" id="phone" value=": 01234567890">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <input type="text" readonly class="form-control-plaintext" id="address" value=": Jawa Timur">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8 d-flex align-items-center">
                    <input type="text" readonly class="form-control-plaintext" id="password" value=": ******">
                    <a href="{{ route('password.index') }}" class="ml-2">Ubah password</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection