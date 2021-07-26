@extends('main')
@section('title', 'Create Kelas')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Kelas</h3>
                    <div class="card-tools">
                        <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-danger">
                            Tutup
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
                    <form action="{{ route('kelas.store') }}" method="post">
                        @csrf
                        <div class="form-group {{ $errors->has('kode_kelas') ? 'has-error' :'' }}">

                            <label for="kode_kelas">Kode Kelas</label>
                            <input type="text" name="kode_kelas" id="kode_kelas" class="form-control" placeholder="Masukkan Kode Kelas" required>
                            <span class="help-block">{{$errors->first('kode_kelas')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('nama') ? 'has-error' :'' }}">

                            <label for="nama">kelas</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Kelas" required>
                            <span class="help-block">{{$errors->first('nama')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('kapasitas') ? 'has-error' :'' }}">
                            <label for="kapasitas">Kapasitas</label>
                            <input type="text" name="kapasitas" id="kapasitas" class="form-control" placeholder="Masukkan Kapasitas Kelas" required>
                            <span class="help-block">{{$errors->first('kapasitas')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('jenjang') ? 'has-error' :'' }}">
                            <label class="control-label">Jenjang *</label>
                            <select name="jenjang" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Awwaliyah">Awwaliyah</option>
                                <option value="Wustha">Wustha</option>
                                <option value="Ulya">Ulya</option>
                            </select>
                            <span class="help-block">{{$errors->first('jenjang')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('wali_kelas') ? 'has-error' :'' }}">
                            <label for="wali_kelas">Wali kelas</label>
                            <select name="wali_kelas" id="wali_kelas" class="form-control" required>
                                <option value="">Pilih Wali Kelas *</option>
                                @foreach($ustad as $item)
                                <option value="{{ $item->id_ustad}}">{{ $item->nama_lengkap}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('wali_kelas')}}</span>

                        </div>
                        <div class="form-group ">

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection