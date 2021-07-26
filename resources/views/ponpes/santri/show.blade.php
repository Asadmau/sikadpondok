@extends('main')
@section('title', 'Halaman Detail')
@section('content')
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-8">
              <!-- general form elements disabled -->
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Data Detail</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" class="form-control" value="{{$santri->nama_santri}}" disabled>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>NISN</label>
                          <input type="text" class="form-control" value="{{$santri->nis}}" disabled>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tempat Lahir</label>
                          <input type="text" class="form-control" value="{{$santri->tmp_lahir}}" disabled>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tanggal Lahir</label>
                          <input type="text" class="form-control" value="{{$santri->tgl_lahir}}" disabled>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Jenis Kelamin</label>
                          <input type="text" class="form-control" value="{{$santri->jenis_kelamin}}" disabled>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Jenjang</label>
                          <input type="text" class="form-control" value="{{$santri->jenjang}}" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Alamat</label>
                          <textarea class="form-control" rows="3" disabled>{{$santri->alamat}}</textarea>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Kamar</label>
                          <input type="text" class="form-control" value="{{$santri->kamar}}" disabled>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tahun Akademik</label>
                          <input type="text" class="form-control" value="{{$santri->thn_akademik}}" disabled>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Ayah</label>
                          <input type="text" class="form-control" value="{{$santri->nama_ayah}}" disabled>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Ibu</label>
                          <input type="text" class="form-control" value="{{$santri->nama_ibu}}" disabled>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Nomer HP/WA</label>
                          <input type="text" class="form-control" value="{{$santri->hp}}" disabled>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="ml-auto col-md-4">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Foto Santri</h5>
              </div>
              <div class="card-body">
                <center>
                    <figure class="figure">
                        <img src="https://bridgelawyers.ca/wp-content/uploads/2020/08/depositphotos_39258143-stock-illustration-businessman-avatar-profile-picture.jpg" class="figure-img img-fluid rounded" width="50%" height="200" alt="">
                        <figcaption class="figure-caption">A caption for the above image.</figcaption>
                      </figure>
                  </center>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Foto Wali</h5>
              </div>
              <div class="card-body">
                  <center>
                    <figure class="figure">
                        <img src="https://bridgelawyers.ca/wp-content/uploads/2020/08/depositphotos_39258143-stock-illustration-businessman-avatar-profile-picture.jpg" class="figure-img img-fluid rounded" width="50%" height="200" alt="">
                        <figcaption class="figure-caption">A caption for the above image.</figcaption>
                      </figure>
                  </center>
                
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
     

@endsection