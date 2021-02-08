@extends('layouts.app_admin')

@push('css') 

@endpush

@section('content')
<a href="/marker" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a> <br /><br />

<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0"> <i class="fas fa-server"></i> Edit Marker Map </h5>
      </div>
      <form method="post" action="/marker/edit/{{$data->id}}" enctype="multipart/form-data">
        @csrf
      <div class="card-body">
        
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
          <div class="col-sm-10">
            <div class="custom-file">
              <select class="form-control" name="warna" required>
                  <option value="Hijau" {{$data->warna == 'Hijau' ? 'selected' :''}}>Hijau</option>
                  <option value="Kuning" {{$data->warna == 'Kuning' ? 'selected' :''}}>Kuning</option>
                  <option value="Merah" {{$data->warna == 'Merah' ? 'selected' :''}}>Merah</option>
                  <option value="Hitam" {{$data->warna == 'Hitam' ? 'selected' :''}}>Hitam</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Icon</label>
            <div class="col-sm-10">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="jumlah"  value="{{$data->jumlah}}" onkeypress="return event.charCode >= 48 && event.charCode <=57" required>
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

<!-- bs-custom-file-input -->
<script src="/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
  </script>
@endpush