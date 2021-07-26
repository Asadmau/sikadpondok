@extends('main')
@section('title', 'Halaman Tambah Kamar')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Data</h3>
                    <div class="card-tools">
                        <a href="{{ route('kamar.index') }}" class="btn btn-sm btn-danger">
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
                    <form action="{{ route('kamar.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Kamar</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="ketua_id">Ketua Kamar</label>
                            <select name="ketua_id" id="ketua_id" class="form-control" required>
                                <option value="">Pilih Ketua</option>
                                @foreach($pengurus as $item)
                                <option value="{{ $item->id_pengurus }}">{{ $item->nama_pengurus }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kapasitas">Jumlah Lemari</label>
                            <input type="number" name="kapasitas" id="kapasitas" class="form-control" required>
                        </div>
                        <div class="form-group">
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