@extends('layouts.app_1')

@section('title', 'Edit profile')

@section('content')
<section class="pofile">
    <div class="profile-card mt-5">
        <form>
            <div class="form-group row">
                <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control-plaintext" id="nama" value=": Nogi">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email account</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control-plaintext" id="email" value=": Nogi123@gmail.com">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-4 col-form-label">Nomor Telepon</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control-plaintext" id="phone" value=": 01234567890">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control-plaintext" id="address" value=": Jawa Timur">
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Submit">
        </form>
    </div>
</section>
@endsection