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
<h5 class="mb-2"><i class="fas fa-virus"></i> Data Covid-19</h5>
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">ODP</span>
          <span class="info-box-number">1,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-success"><i class="far fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">PDP</span>
          <span class="info-box-number">410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-warning"><i class="far fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">OTG</span>
          <span class="info-box-number">13,648</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-danger"><i class="far fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">POSITIF</span>
          <span class="info-box-number">93,139</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <div class="row">
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">DALAM PERAWATAN</span>
        <span class="info-box-number">1,410</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="far fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">SEMBUH</span>
        <span class="info-box-number">410</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="far fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">MENINGGAL</span>
        <span class="info-box-number">13,648</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-danger"><i class="far fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">TOTAL</span>
        <span class="info-box-number">93,139</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0"> <i class="fas fa-virus"></i> Peta Pesebaran Covid-19 </h5>
      </div>
      <div class="card-body">
        <div id="mapid"></div>
        
      </div>
    </div>
  </div>
  <!-- /.col-md-6 -->
</div>
@endsection

@push('js')

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>
<script>
    var map = L.map('mapid').setView([-6.203106313909043, 106.836372623998], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        kelurahan = {!!json_encode($kelurahan)!!}
        console.log(kelurahan, kelurahan.length);
        
        for (var i = 0; i < kelurahan.length; i++) { 
            L.marker([kelurahan[i].lat, kelurahan[i].long]).addTo(map);
            // L.circle([kelurahan[i].lat, kelurahan[i].long], {radius: 300}).addTo(map);
        };
</script>
@endpush