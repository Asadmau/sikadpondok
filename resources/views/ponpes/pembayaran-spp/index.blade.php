@extends('main');
@section('title', 'Bulanan Santri');
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="" action="" accept-charset="UTF-8" class="form-inline well well-sm">
                    <label for="month" class="control-label">Lihat Bulanan per : </label>
                    <div class="ml-1">
                        <div class="form-group">
                            <select id="inputStatus" class="form-control custom-select">
                                <option disabled="">Select one</option>
                                <option>On Hold</option>
                                <option>Canceled</option>
                                <option selected="">Santri</option>
                            </select>
                        </div>
                    </div>
                    <div class="ml-1">
                        <div class="form-group">
                            <select id="inputStatus" class="form-control custom-select">
                                <option disabled="">Select one</option>
                                <option>On Hold</option>
                                <option>Canceled</option>
                                <option selected="">Years</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <select id="inputStatus" class="form-control custom-select">
                            <option disabled="">Select one</option>
                            <option>On Hold</option>
                            <option>Canceled</option>
                            <option selected="">Mounths</option>
                        </select>
                    </div>
                    <div class="offset-md-1">
                        <input class="btn btn-info btn-sm-2" type="submit" value="Lihat Laporan">
                        <a href="" class="btn btn-default btn-sm-2">Bulan Ini</a>
                        <a href="" class="btn btn-default btn-sm-2">Lihat Tahunan</a>
                        <a href="" class="btn btn-default btn-sm-2">History</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
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
                {{-- <table id="example" class="table table-bordered table-striped"> --}}
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Taggal</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Tagihan</th>
                            <th>Keterangan</th>
                            <th style="text-align: center">Status</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                    </thead>
                    @if($data->count() == 0)
                    <tr>
                        <td style="text-align: center" colspan="7">Tidak Ada Data</td>
                    </tr>
                    @else
                    @php
                    $no = 1;
                    @endphp
                    <tbody style="text-align: center">
                        <tr>
                            <td>{{format_rp(8000)}}</td>
                        </tr>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->getSantri->nis}}</td>
                            <td>{{$item->getSantri->nama}}</td>
                            <td>{{$item->getKamar->nama}}</td>
                            <td>{{$item->getSpp->nominal}}</td>
                            {{-- <td><span class="badge bg-{{($item->status == 'A' ) ? 'success' : ($item->status == 'P' ? 'danger' : 'primary' ) }}">
                            @if($item->status == 'A') Aktif @elseif($item->status == 'P') Keluar @else Alumni @endif</span></td> --}}

                            <form action="" method="post" style="display:inline;">
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-success" href=""><i class="fa fa-edit"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                </div>
                            </form>
            </div>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
</div>
@endsection