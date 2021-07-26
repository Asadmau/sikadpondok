@extends('main')
@section('title', 'Data Kelas')
@section('content')
<div class="container-fluid">
    @if(session()->has('warning'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
        {!! session()->get('warning') !!}
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
        {!! session()->get('error') !!}
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Berhasil !</h4>
        {!! session()->get('success') !!}
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Kela</h3>
                    <div class="card-tools">
                        <a href="{{route('kelas.add')}}" class="btn btn-sm btn-primary">
                            Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode Kelas</th>
                                <th>Nama kelas</th>
                                <th>Kapasitas</th>
                                <th>Jenjang</th>
                                <th>Wali kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($data as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->kode_kelas}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->jenjang}}</td>
                                <td>{{$item->kapasitas}}</td>
                                <td>{{($item->wali_kelas == NULL) ? '-':$item->getUstad->nama_lengkap}}</td>
                                <td>
                                    <a href="{{ route('kelas.edit', $item->id_kelas) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('kelas.destroy', $item->id_kelas) }}" method="post" style="display:inline;">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-sm btn-danger mb-2" onclick="return confirm('Data {{$item->nama}} : akan Di hapus? anda yakin ?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode Kelas</th>
                                <th>Nama kelas</th>
                                <th>Kapasitas</th>
                                <th>Jenjang</th>
                                <th>Wali kelas</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

@endsection