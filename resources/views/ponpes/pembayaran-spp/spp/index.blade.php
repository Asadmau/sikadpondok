@extends('main')
@section('title', 'Data SPP')
@section('content')
<div class="container-fluid">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Data spp</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif
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
            <form method="post" action="{{route('spp-pondok.store')}}" enctype="multipart/form-data">
                {{-- @method('post') --}}
                @csrf
                <table class="table table-bordered" id="myForm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Nominal</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="data[0][items]" placeholder="Enter your Name" class="form-control" /></td>
                            <td><input type="number" name="data[0][nominal]" placeholder="Enter your Qty" class="value1 form-control" /></td>
                            {{-- <td><input type="text" name="data[0][price]" placeholder="Enter your Price" class="form-control" /></td> --}}
                            <td style="text-align: center"><button type="button" name="add" id="add" class="btn btn-success">Tambah</button></td>
                        </tr>
                    </tbody>
                    <tr>
                        <td><b>TOTAL</b></td>
                        <td style="text-align: center"><input class="total form-control" type="number" name="total" id="total" readonly></td>
                        {{-- <p>Total Amt:<span class="total"></span></p> --}}
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary col-12 btn-sm">Save</button>

            </form>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="container">
            <table class="table card-table table-hover table-vcenter text-nowrap title">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Invoice</th>
                    <th style="width: 20%;text-align: right;">Action</th>
                </tr>
                @php
                $i=1;
                @endphp
                @foreach ($data as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>IDR. {{ format_rp($item->total) }}</td>
                    <td style="width: 20%;text-align: right;">
                        <div class="btn-group">
                            <a class="btn btn-sm btn-success mx-1" href="{{route('spp-pondok.show', $item->id_spp)}}"><i class="fa fa-book"></i></a>
                            <form method="POST" action="{{route('spp-pondok.destroy', $item->id_spp)}}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit" onclick="alert('apakah anda yakin?')"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    calcSum();

    function calcSum() {
        var myForm = $('#myForm');
        var sum = 0;
        var itemsValue = myForm.find('.value1');
        itemsValue.each(function() {
            var value = Number($(this).val());
            if (!isNaN(value)) sum += value;
            // sum += parseInt($(this).val());
        });
        // return sum;
        $('#total').val(sum);
        // console.log(sum);
    }

    $("#myForm").on("change", ".value1", calcSum);

    // $('body').on("click", ".delete", function(e) {
    //     $(this).parent().remove();
    //     calcSum();
    // });
    var i = 0;

    $("#add").click(function() {

        ++i;
        // event.preventDefault();
        // $('input.value1').last().attr('name', 'data[' + i + ']');
        $("#myForm").append('<tr><td><input type="text" name="data[' + i + '][items]" placeholder="Enter your Name" class="form-control" /></td><td><input type="number" name="data[' + i + '][nominal]" placeholder="Enter your Qty" class="value1 form-control" /></td><td style="text-align:center"><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });

    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
        calcSum();

    });
</script>
@endsection