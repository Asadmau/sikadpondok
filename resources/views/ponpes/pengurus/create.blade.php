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
                    <form method="post" action="{{route('pengurus.store')}}" enctype="multipart/form-data">
                        {{-- @method('post') --}}
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="nama_pengurus">Nama</label>
                                    <input type="text" class="form-control" name="nama_pengurus" id="nama_pengurus" placeholder="Nama Santri" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="number" name="nik" id="nik" class="form-control" placeholder="NIK" required>
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
                                <div class="form-group {{ $errors->has('jk') ? 'has-error' :'' }}">
                                    <label class="control-label" for="jk">Jenik Kelamin *</label>
                                    <select name="jk" id="jk" class="form-control" required>
                                        <option value="" {{old('jk') == '' ? 'selected':''}}>-- Pilih --</option>
                                        <option value="L" {{old('jk') == 'L' ? 'selected':''}}>Laki - laki</option>
                                        <option value="P" {{old('jk') == 'P' ? 'selected':''}}>Perempuan</option>
                                    </select>
                                    <span class="help-block">{{$errors->first('jenik_kelamin')}}</span>
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
                                    <label for="thn_akademik">Tahun Akademik</label>
                                    <input type="number" name="thn_akademik" id="thn_akademik" class="form-control" placeholder="Tahun Akademik" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('foto_pengurus') ? 'has-error' :'' }}">
                                    <label class="control-label">Unggah Foto</label>
                                    <input name="foto_pengurus" type="file" accept="image/*">
                                    <span class="help-block">{{$errors->first('foto_pengurus')}}</span>
                                </div>
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
@endsection