@extends('main')
@section('title', 'Kamar yang Tersedia')
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
                <div class="card-header">
                    <h3 class="card-title">Data Kamar</h3>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Ketua Kamar</th>
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
                                <td>{{$temp->nama}}</td>
                                <td>{{$temp->getKetua->nama_pengurus}}</td>
                                {{-- <td>{{$temp->jenjang}}</td> --}}
                                <td>{{$temp->kapasitas}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group">
                                        <a href="{{route('reg-kamar.list', $temp->id_kamar)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                                        <a href="{{route('reg-kamar.register', [$temp->id_kamar])}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>
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