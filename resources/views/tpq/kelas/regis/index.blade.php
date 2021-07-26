@extends('main')
@section('title', 'Kelas yang Tersedia')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(session()->has('warning'))
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
                    {!! session()->get('warning') !!}
                </div>
                @endif
                <div class="card-header">
                    <h3 class="card-title">Data Kelas</h3>
                    @foreach ($data as $item)
                    {{-- <a href="{{route('rk.test', [$item->id_kelas])}}">Cek</a> --}}
                    @endforeach
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenjang</th>
                                <th>Kapasitas</th>
                                <th style="text-align: center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data->count() == 0)
                            <tr>
                                <td colspan="6">Tidak Ada Data</td>
                            </tr>
                            @else
                            @php
                            $no = 1;
                            @endphp
                            @foreach($data as $temp)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$temp->kode_kelas}}</td>
                                <td>{{$temp->nama}}</td>
                                <td>{{$temp->jenjang}}</td>
                                <td>{{$temp->kapasitas}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group">
                                        <a href="{{route('rk.list', $temp->id_kelas)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                                        <a href="{{route('rk.regis', [$item->id_kelas])}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection