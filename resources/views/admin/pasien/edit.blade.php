@extends('layouts.app_admin')

@push('css') 
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

@endpush

@section('content')
<a href="/pasien" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a> <br /><br />

<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0"> <i class="fas fa-server"></i> Edit Data Pasien </h5>
      </div>
      <form method="post" action="/pasien/edit/{{$data->id}}">
        @csrf
      <div class="card-body">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">No Pasien</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="no_pasien" value="{{$data->no_pasien}}" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select name="jkel" class="form-control">
                <option value="L" {{$data->jkel == 'L' ? 'selected' : ''}}>Pria</option>
                <option value="P" {{$data->jkel == 'P' ? 'selected' : ''}}>Wanita</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Umur</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="umur" required maxlength="3" value="{{$data->umur}}"  onkeypress="return hanyaAngka(event)">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Pekerjaan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="pekerjaan" value="{{$data->pekerjaan}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Hasil</label>
            <div class="col-sm-10">
              <select name="hasil" class="form-control">
                <option value="">-PILIH-</option>
                <option value="KONFIRMASI" {{$data->hasil == 'KONFIRMASI' ? 'selected' : ''}}>KONFIRMASI</option>
                <option value="SUSPECT" {{$data->hasil == 'SUSPECT' ? 'selected' : ''}}>SUSPECT</option>
                <option value="PROBABLE" {{$data->hasil == 'PROBABLE' ? 'selected' : ''}}>PROBABLE</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Gejala</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="gejala" value="{{$data->gejala}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Tgl masuk</label>
            <div class="col-sm-10">
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" name="tgl_masuk" value="{{Carbon\Carbon::parse($data->tgl_masuk)->format('m/d/Y')}}" data-target="#reservationdate"/>
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Tgl keluar</label>
            <div class="col-sm-10">
              <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" name="tgl_keluar" value="{{Carbon\Carbon::parse($data->tgl_keluar)->format('m/d/Y')}}" data-target="#reservationdate2"/>
                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">LOS</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="los" value="{{$data->los}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">KELURAHAN</label>
            <div class="col-sm-10">
              <select name="kelurahan_id" class="form-control">
                <option value="">-PILIH-</option>
                @foreach ($kelurahan as $item)
                <option value="{{$item->id}}" {{$data->kelurahan_id == $item->id ? 'selected' : ''}}>{{$item->nama}}</option>
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
<!-- InputMask -->
<script src="/assets/plugins/moment/moment.min.js"></script>
<script src="/assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
  function hanyaAngka(event) {
      var angka = (event.which) ? event.which : event.keyCode
      if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
          return false;
      return true;
  }
</script>
<script>
  $(function () {
  
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    
    $('#reservationdate2').datetimepicker({
        format: 'L'
    });
  });
</script>
@endpush