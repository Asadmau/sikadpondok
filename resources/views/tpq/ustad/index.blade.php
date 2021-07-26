@extends('main')
@section('title', ' Guru TPQ')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Guru TPQ</h3>
                    <div class="card-tools">
                        <a href="{{route('ustad.create')}}" class="btn btn-sm btn-primary">
                            Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('error'))
                    <div class="alert alert-warning">
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
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Foto</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($data as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->nip}}</td>
                                <td>{{$item->nama_lengkap}}</td>
                                <td>{{$item->tmp_lahir}}</td>
                                <td>{{$item->tgl_lahir}}</td>
                                <td style="text-align: center">{{$item->jenis_kelamin}}</td>
                                <td style="text-align: center">
                                    <img class="img-fluid" height="100" width="30" id="previewSantri" src="#" onerror="this.onerror=null;this.src='{{asset('img/tpq/ustad/'.$item->profile_img)}}';">
                                    {{-- <a href="{{ asset('img/tpq/ustad/'.$item->profile_img) }}" target="_blank" rel="noopener noreferrer">Lihat Foto</a>
                                    {{$item->profile_img}} --}}

                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-success" href="{{url('ustad/'.$item->id_ustad.'/edit')}}"><i class="fa fa-edit"></i></a>
                                        <form method="POST" action="{{route('ustad.destroy', $item->id_ustad)}}">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Data {{$item->nama_lengkap}} akan Di hapus? anda yakin ?')"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</div>
@endsection