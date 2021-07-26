@extends('main')
@section('title', 'Edit ')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8">
            <!-- general form elements  -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Data santri</h3>
                </div>
                <!-- /.card-header -->
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
                    <form action="{{route('santri.update', $data->id_santri)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" value="{{$data->nama}}" placeholder="Nama Santri">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input type="number" name="nis" id="nis" class="form-control" value="{{$data->nis}}" placeholder="NIS">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tmp_lahir">Tempat Lahir</label>
                                    <input type="text" name="tmp_lahir" id="tmp_lahir" class="form-control" value="{{$data->tmp_lahir}}" placeholder="Tempat Lahir">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="{{$data->tgl_lahir}}" placeholder="Tanggal Lahir">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' :'' }}">
                                    <label class="control-label" for="jenis_kelamin">Jenis Kelamin *</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                        <option value="L" {{ $data->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ $data->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('jenjang') ? 'has-error' :'' }}">
                                    <label class="control-label" for="jenjang">Jenjang *</label>
                                    <select name="jenjang" id="jenjang" class="form-control">
                                        <option value="SD" {{$data->jenjang == 'SD' ? 'selected':''}}>SD</option>
                                        <option value="SMP" {{$data->jenjang == 'SMP' ? 'selected':''}}>SMP</option>
                                        <option value="SMK" {{$data->jenjang == 'SMK' ? 'selected':''}}>SMK</option>
                                    </select>
                                    <span class="help-block">{{$errors->first('jenjang')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Alamat">{{$data->alamat}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tahun_akademik"> Tahun Akademik *</label>
                                    <select name="tahun_akademik" id="tahun_akademik" class="form-control">
                                        @foreach($ta as $item)
                                        <option value="{{ $item->id_tahun_akademik }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="nama_ayah">Nama Ayah</label>
                                    <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" value="{{$data->nama_ayah}}" placeholder="Nama Ayah">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pekerjaan_ayah"> Pekerjaan Ayah*</label>
                                    <select name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control">
                                        @foreach($jobs as $item)
                                        <option value="{{ $item->id_pekerjaan }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" value="{{$data->nama_ibu}}" placeholder="Nama Ibu">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pekerjaan_ibu"> Pekerjaan Ibu *</label>
                                    <select name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control">
                                        @foreach($jobs as $item)
                                        <option value="{{ $item->id_pekerjaan }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="nope">HP/WA</label>
                                    <input type="number" class="form-control" name="nope" id="nope" value="{{$data->nope}}" placeholder="No HP">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('status') ? 'has-error' :'' }}">
                                    <label class="control-label" for="status">status *</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="A" {{$data->status == 'A' ? 'selected':''}}>AKtif</option>
                                        <option value="P" {{$data->status == 'P' ? 'selected':''}}>Keluar</option>
                                        <option value="M" {{$data->status == 'M' ? 'selected':''}}>Alumni</option>
                                    </select>
                                    <span class="help-block">{{$errors->first('status')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('kategori') ? 'has-error' :'' }}">
                                    <label class="control-label" for="kategori">Kategori Santri *</label>
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option value="BARU" {{$data->kategori == 'BARU' ? 'selected':''}}>BARU</option>
                                        <option value="LAMA" {{$data->kategori == 'LAMA' ? 'selected':''}}>LAMA</option>
                                    </select>
                                    <span class="help-block">{{$errors->first('kategori')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('foto_santri') ? 'has-error' :'' }}">
                                    <label class="control-label">Unggah Foto Santri</label>
                                    <input name="foto_santri" type="file" value="{{$data->foto_santri}}" accept="image/*" onchange="preSantri(event)">
                                    <span class="help-block">{{$errors->first('foto_santri')}}</span>
                                    <?php 
                                    $santri = ($data->foto_santri == NULL) ? 'default.png':$data->foto_santri;
                                    ?>

                                </div>
                                <div class="col-lg-4 col-xs-12">
                                    <img class="img-fluid" height="200" width="100" id="previewSantri" src="#" onerror="this.onerror=null;this.src='{{asset('img/santri/'.$santri)}}';">
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="form-group {{ $errors->has('foto_wali') ? 'has-error' :'' }}">
                                    <label class="control-label" for="foto_wali">Unggah Foto Wali</label>
                                    <input name="foto_wali" id="foto_wali" type="file" value="{{$data->foto_wali}}" accept="image/*" onchange="preWali(event)">
                                    <span class="help-block">{{$errors->first('foto_wali')}}</span>
                                    <?php  $wali = ($data->foto_wali == NULL) ? 'default.png':$data->foto_wali; ?>

                                </div>
                                <div class="col-sm-6">
                                    <img class="img-fluid" height="200" width="100" id="previewWali" src="#" onerror="this.onerror=null;this.src='{{asset('img/wali/'.$wali)}}';">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mt-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                </div>
                            </div>
                        </div>

                </div>
            </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div>
</div>
@endsection