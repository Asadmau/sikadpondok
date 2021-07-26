@extends('main')
@section('title', 'Buat Baru ')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8">
            <!-- general form elements  -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Data Pengurus</h3>
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
                    <form method="post" action="{{route('santri.store')}}" enctype="multipart/form-data">
                        {{-- @method('post') --}}
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Santri" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input type="number" name="nis" id="nis" class="form-control" placeholder="NIK" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tmp_lahir">Tempat Lahir</label>
                                    <input type="text" name="tmp_lahir" id="tmp_lahir" class="form-control" placeholder="Tempat Lahir" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' :'' }}">
                                    <label class="control-label" for="jenis_kelamin">Jenis Kelamin *</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                        <option value="" {{old('jenis_kelamin') == '' ? 'selected':''}}>-- Pilih --</option>
                                        <option value="L" {{old('jenis_kelamin') == 'L' ? 'selected':''}}>Laki-laki</option>
                                        <option value="P" {{old('jenis_kelamin') == 'P' ? 'selected':''}}>Perempuan</option>
                                    </select>
                                    <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('jenjang') ? 'has-error' :'' }}">
                                    <label class="control-label">Jenjang *</label>
                                    <select name="jenjang" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="SD" {{(old('jenjang') == 'SD') ? 'selected':''}}>SD</option>
                                        <option value="SMP" {{(old('jenjang') == 'SMP') ? 'selected':''}}>SMP</option>
                                        <option value="SMK" {{(old('jenjang') == 'SMK') ? 'selected':''}}>SMK</option>
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
                                    <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Alamat" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tahun_akademik">Tahun Akademik *</label>
                                    <select name="tahun_akademik" id="tahun_akademik" class="form-control" required>
                                        <option value="">Pilih Tahun</option>
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
                                    <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="Nama Ayah" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pekerjaan_ayah">pekerjaan ayah *</label>
                                    <select name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control" required>
                                        <option value="">Pilih Pekerjaan</option>
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
                                    <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Nama Ibu" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pekerjaan_ibu">pekerjaan Ibu *</label>
                                    <select name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control" required>
                                        <option value="">Pilih Pekerjaan</option>
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
                                    <input type="number" class="form-control" name="nope" id="nope" placeholder="No HP" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('foto_santri') ? 'has-error' :'' }}">
                                    <label class="control-label">Unggah Foto</label>
                                    <input name="foto_santri" type="file" accept="image/*">
                                    <span class="help-block">{{$errors->first('foto_santri')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('foto_wali') ? 'has-error' :'' }}">
                                    <label class="control-label">Unggah Foto</label>
                                    <input name="foto_wali" type="file" accept="image/*">
                                    <span class="help-block">{{$errors->first('foto_wali')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>

        </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection