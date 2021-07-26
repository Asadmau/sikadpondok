@extends('main')
@section('title', 'Edit Data')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Santri TPQ</h3>
                    <div class="card-tools box-header with-border ml-auto">
                        <a class="btn btn-sm btn-danger" href="{{route('siswa.index')}}">
                            <i class="fa fa-reply"></i> Kembali
                        </a>
                    </div>
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
                    <form method="POST" action="{{route('siswa.update', $data->id_santri_tpq)}}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('nisn') ? 'has-error' :'' }}">
                                <label class="control-label">NISN *</label>
                                <input name="nisn" value="{{$data->nisn}}" type="number" class="form-control" placeholder="Masukkan NISN" maxlength="10" required>
                                <span class="help-block">{{$errors->first('nisn')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('nama') ? 'has-error' :'' }}">
                                <label class="control-label">Nama Santri *</label>
                                <input name="nama" value="{{$data->nama}}" type="text" class="form-control" placeholder="Masukkan Nama Santri" maxlength="100" required>
                                <span class="help-block">{{$errors->first('nama')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('tmp_lahir') ? 'has-error' :'' }}">
                                <label class="control-label">Tempat Lahir *</label>
                                <input name="tmp_lahir" value="{{$data->tmp_lahir}}" type="text" class="form-control" placeholder="Masukkan Tempat Lahir" maxlength="20" required>
                                <span class="help-block">{{$errors->first('tmp_lahir')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('tgl_lahir') ? 'has-error' :'' }}">
                                <label class="control-label">Tanggal Lahir *</label>
                                <input name="tgl_lahir" value="{{$data->tgl_lahir}}" type="date" class="form-control" placeholder="Masukkan Tanggal Lahir" maxlength="10" required>
                                <span class="help-block">{{$errors->first('tgl_lahir')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' :'' }}">
                                <label class="control-label">Jenis Kelamin *</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="Laki-laki" {{$data->jenis_kelamin == 'Laki-laki' ? 'selected':''}}>Laki-laki</option>
                                    <option value="Perempuan" {{$data->jenis_kelamin== 'Perempuan' ? 'selected':''}}>Perempuan</option>
                                </select>
                                <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('alamat') ? 'has-error' :'' }}">
                                <label class="control-label">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" style="resize:none" rows="3">{{$data->alamat}}</textarea>
                                <span class="help-block">{{$errors->first('alamat')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('telepon') ? 'has-error' :'' }}">
                                <label class="control-label">HP/WA</label>
                                <input name="hp_wa" value="{{$data->hp_wa}}" type="text" class="form-control" placeholder="Masukkan Nomor HP/WA" maxlength="20">
                                <span class="help-block">{{$errors->first('hp_wa')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('nama_ayah') ? 'has-error' :'' }}">
                                <label class="control-label">Nama Ayah *</label>
                                <input name="nama_ayah" value="{{$data->nama_ayah}}" type="text" class="form-control" placeholder="Masukkan Nama Ayah" maxlength="100" required>
                                <span class="help-block">{{$errors->first('nama_ayah')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('pekerjaan_ayah') ? 'has-error' :'' }}">
                                <label class="control-label">Pekerjaan Ayah *</label>
                                <select name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control" required>
                                    @foreach($jobs as $temp)
                                    <option value="{{ $temp->id_pekerjaan }}">{{ $temp->nama }}</option>
                                    {{-- <option value="{{$temp->id_pekerjaan}}">{{$temp->nama}}</option> --}}
                                    @endforeach
                                </select>
                                <span class="help-block">{{$errors->first('pekerjaan_ayah')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('nama_ibu') ? 'has-error' :'' }}">
                                <label class="control-label">Nama Ibu *</label>
                                <input name="nama_ibu" value="{{$data->nama_ibu}}" type="text" class="form-control" placeholder="Masukkan Nama Ibu" maxlength="100" required>
                                <span class="help-block">{{$errors->first('nama_ibu')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('pekerjaan_ibu') ? 'has-error' :'' }}">
                                <label class="control-label">Pekerjaan Ibu *</label>
                                <select name="pekerjaan_ibu" class="form-control" required>
                                    @foreach($jobs as $temp)
                                    <option value="{{$temp->id_pekerjaan}}">{{$temp->nama}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{$errors->first('pekerjaan_ibu')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('jenjang') ? 'has-error' :'' }}">
                                <label class="control-label">Jenjang *</label>
                                <select name="jenjang" class="form-control" required>
                                    <option value="Awwaliyah" {{$data->jenjang == 'Awwaliyah' ? 'selected': ''}}>Awwaliyah</option>
                                    <option value="Wustha" {{$data->jenjang == 'Wustha' ? 'selected': ''}}>Wustha</option>
                                    <option value="Ulya" {{$data->jenjang == 'Ulya' ? 'selected': ''}}>Ulya</option>
                                </select>
                                <span class="help-block">{{$errors->first('jenjang')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('tahun_akademik') ? 'has-error' :'' }}">
                                <label class="control-label">Tahun Akademik *</label>
                                <select name="tahun_akademik" class="form-control" required>
                                    @foreach($ta as $temp)
                                    <option value="{{$temp->id_tahun_akademik}}">{{$temp->nama}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{$errors->first('tahun_akademik')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('status') ? 'has-error' :'' }}">
                                <label class="control-label">Status Santri *</label>
                                <select name="status" class="form-control" required>
                                    <option value="" {{$data->status == '' ? 'selected':''}}>-- Pilih --</option>
                                    <option value="A" {{$data->status == 'A' ? 'selected':''}}>Aktif</option>
                                    <option value="P" {{$data->status == 'P' ? 'selected':''}}>Keluar</option>
                                    <option value="M" {{$data->status == 'M' ? 'selected':''}}>Alumni</option>
                                </select>
                                <span class="help-block">{{$errors->first('status')}}</span>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group {{ $errors->has('photo_santri') ? 'has-error' :'' }}">
                                        <label class="control-label">Unggah Foto Santri</label>
                                        <input name="photo_santri" type="file" accept="image/*" onchange="preSantri(event)">
                                        <span class="help-block">{{$errors->first('photo_santri')}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group {{ $errors->has('photo_ayah') ? 'has-error' :'' }}">
                                        <label class="control-label">Unggah Foto Ayah</label>
                                        <input name="photo_ayah" type="file" accept="image/*" onchange="preWali(event)">
                                        <span class="help-block">{{$errors->first('photo_ayah')}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group {{ $errors->has('photo_ibu') ? 'has-error' :'' }}">
                                        <label class="control-label">Unggah Foto Ibu</label>
                                        <input name="photo_ibu" type="file" accept="image/*" onchange="preWaliibu(event)">
                                        <span class="help-block">{{$errors->first('photo_ibu')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4 col-xs-12">
                                    <img class="img-fluid" height="200" width="100" id="previewSantri" src="#" onerror="this.onerror=null;this.src='{{asset('img/tpq/siswa/'.$data->photo_santri)}}';">
                                </div>
                                <div class="col-lg-4 col-xs-12">
                                    <img class="img-fluid" height="200" width="100" id="previewWali" src="#" onerror="this.onerror=null;this.src='{{asset('img/tpq/wali/'.$data->photo_ayah)}}';">
                                </div>
                                <div class="col-lg-4 col-xs-12">
                                    <img class="img-fluid" height="200" width="100" id="previewWaliibu" src="#" onerror="this.onerror=null;this.src='{{asset('img/tpq/wali/'.$data->photo_ibu)}}';">
                                </div>
                            </div>
                            <div class="box-footer with-border mt-2">
                                <div class="btn-group">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                    <button type="reset" class="btn btn-primary" onclick="return confirm('Perubahan Akan Di Batalkan, OKE/CANCEL')">reset</button>
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Simpan Perubahan?')">Simpan</button>
                                </div>
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