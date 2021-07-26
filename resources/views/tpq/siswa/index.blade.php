@extends('main')
@section('title', 'Halaman Santri TPQ')
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
                    <h3 class="card-title">Data siswa</h3>
                    <div class="card-tools">
                        <a href="{{ route('siswa.create') }}" class="btn btn-sm btn-primary">
                            Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Jenjang</th>
                                <th>Tahun Akademik</th>
                                <th style="text-align: center">Status</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data->count() == 0)
                            <tr>
                                <td colspan="7">Tidak Ada Data</td>
                            </tr>
                            @else
                            @php
                            $no = 1;
                            @endphp

                            @foreach ($data as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->nisn}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->tmp_lahir}}</td>
                                <td>{{$item->tgl_lahir}}</td>
                                <td>{{$item->jenis_kelamin}}</td>
                                <td>{{$item->jenjang}}</td>
                                <td>{{$item->getTahunAkademik->nama}}</td>
                                <td><span class="badge bg-{{($item->status == 'A' ) ? 'success' : ($item->status == 'P' ? 'danger' : 'primary' ) }}">
                                        @if($item->status == 'A') Aktif @elseif($item->status == 'P') Keluar @else Alumni @endif</span></td>

                                <td>
                                    <div class="btn-group">
                                        {{-- <a class="btn btn-sm btn-success" href="{{url('siswa/'.$item->id_siswa.'/edit')}}"><i class="fa fa-edit"></i></a> --}}
                                        <form action="{{ route('siswa.destroy', $item->id_santri_tpq) }}" method="post" style="display:inline;">
                                            @csrf
                                            {{-- {{ method_field('delete') }} --}}
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-success" href="{{url('siswa/'.$item->id_santri_tpq.'/edit')}}"><i class="fa fa-edit"></i></a>
                                                @method('DELETE')
                                                {{-- @csrf --}}
                                                {{-- <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Data {{$item->nama}} akan Di hapus? anda yakin ?')"><i class="fa fa-trash"></i></button> --}}
                                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Data {{$item->nama}} akan Di hapus? anda yakin ?')"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
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