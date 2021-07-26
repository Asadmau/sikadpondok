@extends('main')
@section('title', 'Data Tahun Akademik')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Tahun Akademik</h3>
                    <div class="card-tools">
                        <a href="{{ route('tahun-akademik.create') }}" class="btn btn-sm btn-primary">
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
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>Tahun Akademik</th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Action</th>
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
                                    {{ $item->nama}}
                                </td>
                                {{-- <td style="text-align: center">
                                    <a href="{{ route('tahun-akademik.edit', $item->id_tahun_akademik) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                                <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('tahun-akademik.destroy', $item->id_tahun_akademik) }}" method="post" style="display:inline;">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-sm btn-danger mb-2" onclick="return confirm('Apakah Anda Akan Menghapusnya?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                </td> --}}
                                <td style="text-align: center"><span class="badge bg-{{($item->status == 'A' ? 'success':'danger')}}">{{($item->status == 'A' ? 'Aktif':'Nonaktif')}}</span></td>
                                <td style="text-align: center">
                                    <div class="btn-group">
                                        <form action="{{ route('tahun-akademik.destroy', $item->id_tahun_akademik) }}" method="post" style="display:inline;">

                                            @if($item->status == 'A')
                                            <a href="{{route('tahun-akademik.apply', $item->id_tahun_akademik)}}" class="btn-sm btn-primary">Nonaktifkan</a>
                                            @else
                                            <a href="{{route('tahun-akademik.apply', $item->id_tahun_akademik)}}" class="btn-sm btn-success">Aktifkan</a>
                                            @endif
                                            <a href="{{ route('tahun-akademik.edit', $item->id_tahun_akademik) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-sm btn-danger mb-2" onclick="return confirm('Apakah Anda Akan Menghapusnya?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        {{-- <a href="{{route('tahun-akademik.edit', $item->id_tahun_akademik)}}" class="btn-sm btn-warning" data-toggle="modal" data-target=".edit-ta"></a>
                                        <a href="{{route('tahun-akademik.destroy', $item->id_tahun_akademik)}}" class="btn-sm btn-danger" data-toggle="modal" data-target=".confirm-delete"><i class="fa fa-trash"></i></a> --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tahun Akademik</th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Action</th>
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