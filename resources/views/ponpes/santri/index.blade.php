@extends('main')
@section('title', 'Halaman Santri')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Santri</h3>
                    <div class="card-tools">
                        <a href="{{ route('santri.create') }}" class="btn btn-sm btn-primary">
                            Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Tahun Akademik</th>
                                <th style="text-align: center">Status</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                        </thead>
                        @if($data->count() == 0)
                        <tr>
                            <td colspan="7">Tidak Ada Data</td>
                        </tr>
                        @else
                        @php
                        $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->nis}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->tmp_lahir}}</td>
                                <td>{{$item->tgl_lahir}}</td>
                                <td>{{$item->jenis_kelamin}}</td>

                                <td>{{$item->getTahunAkademik->nama}}</td>
                                <td><span class="badge bg-{{($item->status == 'A' ) ? 'success' : ($item->status == 'P' ? 'danger' : 'primary' ) }}">
                                        @if($item->status == 'A') Aktif @elseif($item->status == 'P') Keluar @else Alumni @endif</span></td>

                                {{-- <td>
                                    <a href="{{ asset('img/santri/'.$item->foto_santri) }}" target="_blank" rel="noopener noreferrer">Lihat Foto</a>

                                </td> --}}
                                <td>
                                    <div class="btn-group">
                                        {{-- <a class="btn btn-sm btn-success" href="{{url('santri/'.$item->id_santri.'/edit')}}"><i class="fa fa-edit"></i></a> --}}
                                        <form action="{{ route('santri.destroy', $item->id_santri) }}" method="post" style="display:inline;">
                                            @csrf
                                            {{-- {{ method_field('delete') }} --}}
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-success" href="{{url('santri/'.$item->id_santri.'/edit')}}"><i class="fa fa-edit"></i></a>
                                                {{-- @csrf --}}
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                            </div>
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
                                <th>Tahun Akademik</th>
                                <th style="text-align: center">Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    @endif
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</div>
@endsection