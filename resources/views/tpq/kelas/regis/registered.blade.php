@extends('main')
@section('title', 'Daftar Santri')
@section('content')
<div class="container-fluid">
    @if(session()->has('warning'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
        {!! session()->get('warning') !!}
    </div>
    @elseif(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Berhasil !</h4>
        {!! session()->get('success') !!}
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card">
                    <div class="card-header content-header">
                        <h3 class="card-title">
                            Daftar siswa TPQ
                            <small>{{$data['kelas']->nama}}</small>
                        </h3>
                        <div class="card-tools mr-auto">
                            <a href="{{route('regiskelas.rk')}}" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Tahun Akademik</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @if($data['santritpq']->count() == 0)
                            <tr>
                                <td colspan="8">Tidak Ada Data</td>
                            </tr>
                            @else
                            @foreach($data['santritpq'] as $temp)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$temp->getSantri->nama}}</td>
                                <td>{{$temp->getSantri->nisn}}</td>
                                <td><i class='fa fa-{{$temp->getSantri->jenis_kelamin == 'Laki-laki' ? "male":"female"}}'></i> {{$temp->getSantri->jenis_kelamin == 'Laki-laki' ? "Laki-laki":"Perempuan"}}</td>
                                <td>{{$temp->getSantri->tmp_lahir}}</td>
                                <td>{{$temp->getSantri->tgl_lahir}}</td>
                                <td>{{$temp->getTahunAkademik->nama}}</td>
                                <td>
                                    <div class="btn-group">
                                        {{-- <a href="{{route('regis.rk.delete', $temp->id_regis_kelas)}}" onclick="return confirm('apakah anda yakin?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> --}}
                                        <a href="{{route('regiskelas.rk.delete', ['kelas' => $data['kelas']->id_kelas, $temp->id_regis_kelas])}}" onclick="return confirm('apakah anda yakin?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        {{-- <a href="{{route('akademik.rk.delete', ['kelas' => $data['kelas']->id_kelas, 'id_kelas' => $temp->id_regis])}}" onclick="return confirm('apakah anda yakin?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> --}}
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
<div class="modal fade confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#dd4b39;color:#FFFFFF">
                <h4 class="modal-title">Peringatan !</h4>
            </div>
            <div class="modal-body messages">
                <!-- NTONG DIEUSIAN -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-ok">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endsection