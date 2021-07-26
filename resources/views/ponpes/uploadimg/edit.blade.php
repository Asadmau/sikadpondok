@extends('main')
@section('title', 'Halaman Edit Kamar')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">From Edit</h3>
                    <div class="card-tools">
                        <a href="{{ route('upload.index') }}" class="btn btn-sm btn-danger">
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
                    <form action="{{route('upload.update', $data->id_img)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="nama_img">Gambar</label>
                            <input type="text" name="nama_img" id="nama_img" value="{{$data->nama_img}}" class="form-control" required>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group {{ $errors->has('src_img') ? 'has-error' :'' }}">
                                <label class="control-label">Unggah Foto</label>
                                <input name="src_img" type="file" accept="storage/*" onchange="preSantri(event)">
                                <span class="help-block">{{$errors->first('src_img')}}</span>
                            </div>
                            <div class="row">
                                <?php 
                                $santri = ($data->src_img == NULL) ? 'default.png':$data->src_img;
                            ?>
                                <div class="col-lg-4 col-xs-12">
                                    <img class="img-fluid" height="200" width="100" id="previewSantri" src="#" onerror="this.onerror=null;this.src='{{asset('img/'.$santri)}}';">
                                </div>
                            </div>
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