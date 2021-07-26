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
                        <a href="{{ route('kamar.create') }}" class="btn btn-sm btn-primary">
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
                                <th>Nama Kamar</th>
                                <th>Ketua Kamar</th>
                                <th>Jumlah Lemari</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($kamar as $item)
                            <tr>
                                <td>
                                    {{ $no++ }}
                                </td>
                                <td>
                                    {{ $item->nama_kamar }}
                                </td>
                                <td>
                                    @foreach ($pengurus as $items)
                                    {{ $items->nama_pengurus}}
                                    @endforeach
                                </td>
                                <td>
                                    {{ $item->jml_lemari }}
                                </td>
                                <td>
                                    <a href="{{ route('kamar.edit', $item->id) }}"
                                        class="btn btn-sm btn-primary mr-2 mb-2">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('kamar.destroy', $item->id) }}" method="post"
                                        style="display:inline;">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-sm btn-danger mb-2">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Kamar</th>
                                <th>Ketua Kamar</th>
                                <th>Jumlah Lemari</th>
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