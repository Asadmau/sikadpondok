@extends('main')
@section('title' , 'Registrasi Santri ')
@section('content')
<div class="container-fluid">
    @if(session()->has('warning'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
        {!! session()->get('warning') !!}
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header content-header">
                    <h3 class="card-title">
                        Registrasi siswa
                        <small>{{$data['kelas']->nama}}</small>
                    </h3>
                    <div class="card-tools mr-auto">
                        <a href="{{route('regiskelas.rk')}}" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <form method="POST" action="{{route('regiskelas.rk.store',$data['kelas']->id_kelas)}}">
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
                                </tr>
                            </thead>
                            <tbody>
                                @if($data['santritpq']->count() == 0)
                                <tr>
                                    <td colspan="7">Tidak Ada Data</td>
                                </tr>
                                @else
                                @foreach($data['santritpq']->paginate($data['numShow']) as $temp)
                                <tr>
                                    <td><input name="reg[]" class="register" type="checkbox" value="{{$temp->id_santri_tpq}}" /></td>
                                    <td>{{$temp->nama}}</td>
                                    <td>{{$temp->nisn}}</td>
                                    <td><i class='fa fa-{{$temp->jenis_kelamin == 'Laki-laki' ? "male":"female"}}'></i> {{$temp->jenis_kelamin == 'Laki-laki' ? "Laki-laki":"Perempuan"}}</td>
                                    <td>{{$temp->tmp_lahir}}</td>
                                    <td>{{$temp->tgl_lahir}}</td>
                                    <td>{{$temp->getTahunAkademik->nama}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <br />
                        <i>Santri Terpilih <small class="counter"></small> dari <small>{{$data['kapasitas']}}</small> sisa kursi yang tersedia</i>
                        <br /><br />
                        {{ $data['santritpq']->paginate($data['numShow'])->links() }}
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" class="kapasitas" value="{{$data['kapasitas']}}" />
                        <span style="float: right">
                            <div class="btn-group" style="margin: 20px 0;">
                                <input class="btn btn-warning reset ml-auto" type="reset" value="Kosongkan" />
                                <input class="btn btn-success saved" type="submit" value="Simpan" />
                            </div>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection