@extends('main')
@section('title', 'Halaman Edit pekerjaan')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">From Edit</h3>
                    <div class="card-tools">
                        <a href="{{ route('pekerjaan.index') }}" class="btn btn-sm btn-danger">
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
                    <form action="{{route('pekerjaan.update', $pekerjaan->id_pekerjaan)}}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="nama">pekerjaan</label>
                            <input type="text" name="nama" id="nama" value="{{$pekerjaan->nama}}" placeholder="Masukkan Nama Pekerjaan" class="form-control" required>
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