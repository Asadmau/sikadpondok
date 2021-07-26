@extends('main')
@section('title', 'Buat Baru ')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Form Data Ustad</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('ustad.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Nama Lengkap ustad</label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">NIP</label>
                                    <input type="number" class="form-control" name="nip">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin">
                                        <option selected>pilih...</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Tahun Ajaran</label>
                                    <input type="number" class="form-control" name="thn_ajaran" id="thn_ajaran">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Alamat ustad</label>
                                    <textarea class="form-control" name="alamat_ustad" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Nomor HP/WA</label>
                                    <input class="form-control" type="tel" placeholder="081123678" name="no_hp_ustad">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-floating-label">Upload Foto</label>
                                    <input type="file" name="profile_img" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Tambah Data</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Cek</h3>
                </div>
                <div class="box-body">
                    <div class="callout callout-danger">
                        <h4>I am a danger callout!</h4>

                        <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul,
                            like these sweet mornings of spring which I enjoy with my whole heart.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection