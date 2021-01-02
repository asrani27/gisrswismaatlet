@extends('layouts.app_admin')

@push('css') 
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<style>
    #mapid { height: 500px; }
</style>
@endpush

@section('content')
<a href="/pasien" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a> <br /><br />

<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0"> <i class="fas fa-server"></i> Tambah Data Pasien </h5>
      </div>
      <form method="post" action="/pasien/add">
        @csrf
      <div class="card-body">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">No Pasien</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="no_pasien" placeholder="No pasien" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select name="jkel" class="form-control">
                <option value="L">Pria</option>
                <option value="P">Wanita</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Umur</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="umur" required maxlength="3" onkeypress="return hanyaAngka(event)">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Pekerjaan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="pekerjaan" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Hasil</label>
            <div class="col-sm-10">
              <select name="hasil" class="form-control">
                <option value="">-PILIH-</option>
                <option value="KONFIRMASI">KONFIRMASI</option>
                <option value="SUSPECT">SUSPECT</option>
                <option value="PROBABLE">PROBABLE</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Gejala</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="gejala">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Tgl masuk</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" name="tgl_masuk" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Tgl keluar</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" name="tgl_keluar" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">LOS</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="los">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">KELURAHAN</label>
            <div class="col-sm-10">
              <select name="kelurahan_id" class="form-control">
                <option value="">-PILIH-</option>
                @foreach ($kelurahan as $item)
                <option value="{{$item->id}}">{{$item->nama}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                  <button type="submit" class="btn btn-sm btn-block bg-gradient-primary">Simpan</button>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
  <!-- /.col-md-6 -->
</div>
@endsection

@push('js')
<script>
  function hanyaAngka(event) {
      var angka = (event.which) ? event.which : event.keyCode
      if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
          return false;
      return true;
  }
</script>
@endpush