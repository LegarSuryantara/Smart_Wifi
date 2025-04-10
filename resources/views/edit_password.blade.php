@extends('layouts.app_1')

@section('title', 'Edit Passsword')

@section('content')
<section class="ubahpassword">
    <div class="editpassword-card mt-5">
        <div class="row align-items-center">
            <div class="col-6">
                <h1>Ubah password</h1>
            </div>
            <div class="col">
                <form>
                    <div class="col">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1" class="form-label">Masukkan Password/sandi baru anda</label>
                                <input type="password" class="form-control" id="editpassword" value="12345678">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="nama" class="col-sm-4 col-form-label">Konfirmasi sandi baru</label>
                                <input type="password" class="form-control" id="editpassword">
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</section>
@endsection