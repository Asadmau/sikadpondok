@extends('main')
@section('title', 'Halaman Data Pengurus')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pengurus</h3>
                    <div class="card-tools">
                        <a href="{{route('pengurus.create')}}" class="btn btn-sm btn-primary">
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
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Tahun Akademik</th>
                                <th>Foto</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($pengurus as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->nik}}</td>
                                <td>{{$item->nama_pengurus}}</td>
                                <td>{{$item->tmp_lahir}}</td>
                                <td>{{$item->tgl_lahir}}</td>
                                <td><i class='fa fa-{{$item->jk == 'L' ? "male":"female"}}'></i> {{$item->jk == 'L' ? "Laki-laki":"Perempuan"}}</td>
                                <td>{{$item->thn_akademik}}</td>
                                <td style="text-align: center">
                                    {{-- <a href="{{ asset('img/pengurus/'.$item->foto_pengurus) }}" target="_blank" rel="noopener noreferrer">Lihat Foto</a> --}}
                                    <img class="img-fluid" height="100" width="30" id="previewSantri" src="#" onerror="this.onerror=null;this.src='{{asset('img/pengurus/'.$item->foto_pengurus)}}';">

                                </td>

                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-success" href="{{url('pengurus/'.$item->id_pengurus.'/edit')}}"><i class="fa fa-edit"></i></a>
                                        <form method="POST" action="{{route('pengurus.destroy', $item->id_pengurus)}}">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="alert('apakah anda yakin? {{$item->nama_pengurus}}')"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Tahun Akademik</th>
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