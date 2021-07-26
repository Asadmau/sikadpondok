@extends('main')
@section('title', 'Edit Data')
@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- <div invoice p-3 mb-3> --}}
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Data</h3>
                </div>
                <div class="card-body">
                    @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <form action="{{ route('ustad.update', $data->id_ustad) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Nama Lengkap ustad</label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="{{$data->nama_lengkap}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">NIP</label>
                                    <input type="number" class="form-control" name="nip" value="{{$data->nip}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir" value="{{$data->tmp_lahir}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="{{$data->tgl_lahir}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin">
                                        {{-- <option value="{{$data->jenis_kelamin}}"">{{$data->jenis_kelamin}}</option> --}}
                                        <option value="Laki-laki" {{$data->jenis_kelamin == 'Laki-laki' ? 'selected':''}}>Laki-laki</option>
                                        <option value="Perempuan" {{$data->jenis_kelamin== 'Perempuan' ? 'selected':''}}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Tahun Ajaran</label>
                                    <input type="number" class="form-control" name="thn_ajaran" id="thn_ajaran" value="{{$data->thn_ajaran}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Alamat ustad</label>
                                    <textarea class="form-control" name="alamat_ustad" cols="30" rows="5">{{$data->alamat_ustad}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Nomor HP/WA</label>
                                    <input class="form-control" type="tel" placeholder="081123678" name="no_hp_ustad" value="{{$data->no_hp_ustad}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('profile_img') ? 'has-error' :'' }}">
                                <label class="control-label">Unggah Foto Ustad</label>
                                <input name="profile_img" type="file" value="{{$data->profile_img}}" accept="image/*" onchange="preSantri(event)">
                                <span class="help-block">{{$errors->first('profile_img')}}</span>
                                <?php 
                                    $santri = ($data->profile_img == NULL) ? 'default.png':$data->profile_img;
                                    ?>

                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <img class="img-fluid" height="200" width="100" id="previewSantri" src="#" onerror="this.onerror=null;this.src='{{asset('img/tpq/ustad/'.$santri)}}';">
                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{ route('ustad.index') }}" onclick="return confirm('apakah anda yakin ?')" class="btn bg-danger float-right" style="margin-right: 5px;">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    Simpan Edit
                                </button>
                            </div>
                        </div>
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