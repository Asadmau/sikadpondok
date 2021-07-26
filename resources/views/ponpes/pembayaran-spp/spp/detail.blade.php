@extends('main')
@section('title', 'Rincian Spp')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tanggal Input : {{$spp_pondok->created_at->format('d-m-Y')}}</h3>
                <div class="card-tools">
                    <a href="{{ route('spp-pondok.index') }}" class="btn btn-sm btn-danger">
                        Tutup
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table card-table table-hover table-vcenter text-nowrap title">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Items</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    @php
                    $i = 1;
                    @endphp
                    <tbody>
                        {{-- @php
                    dd($nama);
                    @endphp --}}
                        @foreach ($nama as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->items}}</td>
                            <td>{{$item->nominal}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <td style="width: 60%"></td>
                        <td style="width: 20%;text-align: right;"><b>TOTAL</b></td>
                        <td style="width: 20%;">IDR. <span id="total">{{ $spp_pondok->total }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection