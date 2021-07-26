@extends('main')
@section('title', 'Data Kamar')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Kamar</h3>
                    <div class="card-tools">
                        <a href="{{route('upload.create')}}" class="btn btn-sm btn-primary">
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
                                <th>Nama Gmabar</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($data as $item)
                            <tr>
                                <td>
                                    {{ $no++ }}
                                </td>
                                <td>
                                    {{ $item->nama_img }}
                                </td>
                                <td>
                                    <a href="{{ asset('img/'.$item->src_img) }}" target="_blank" rel="noopener noreferrer">Lihat gambar</a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-success" href="{{url('upload/'.$item->id_img.'/edit')}}"><i class="fa fa-edit"></i></a>
                                        <form method="POST" action="{{route('upload.destroy', $item->id_img)}}">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="alert('apakah anda yakin?')"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Gmabar</th>
                                <th>Gambar</th>
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