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
<h5 class="mb-2"><i class="fas fa-virus"></i> Data Covid-19 Tanggal {{\Carbon\Carbon::today()->format('d M Y')}}</h5>
  <div class="row">
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">KONFIRMASI</span>
          <span class="info-box-number">{{konfirmasiToday()}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-success"><i class="far fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">SUSPECT</span>
          <span class="info-box-number">{{suspectToday()}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-danger"><i class="far fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">PROBABLE</span>
          <span class="info-box-number">{{probableToday()}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  
<h5 class="mb-2"><i class="fas fa-virus"></i> Data Covid-19 Akumulasi</h5>
  <div class="row">
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">KONFIRMASI</span>
          <span class="info-box-number">{{konfirmasi()}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-success"><i class="far fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">SUSPECT</span>
          <span class="info-box-number">{{suspect()}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-danger"><i class="far fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">PROBABLE</span>
          <span class="info-box-number">{{probable()}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
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
<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0"> <i class="fas fa-chart-line"></i> Grafik Data Covid-19 </h5>
      </div>
      <div class="card-body">
        <canvas id="myChart" width="400" height="120"></canvas>
      </div>
    </div>
  </div>
  <!-- /.col-md-6 -->
</div>

@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>


<script>
  
    var map = L.map('mapid').setView([-6.203106313909043, 106.836372623998], 10);
    

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        kelurahan = {!!json_encode($kelurahan)!!}
   
        var greenIcon = L.icon({
            iconUrl: '/storage/25-12-2020-03-40-17iconfinder_archlinux_386451.png',
        });
        
        for (var i = 0; i < kelurahan.length; i++) { 
          let dataPasien = kelurahan[i].pasien;
          var nop1 = kelurahan[i].pasien[0] == null ? '' : kelurahan[i].pasien[0].no_pasien;
          var nop2 = kelurahan[i].pasien[1] == null ? '' : kelurahan[i].pasien[1].no_pasien;
          var nop3 = kelurahan[i].pasien[2] == null ? '' : kelurahan[i].pasien[2].no_pasien;
          var nop4 = kelurahan[i].pasien[3] == null ? '' : kelurahan[i].pasien[3].no_pasien;
          var nop5 = kelurahan[i].pasien[4] == null ? '' : kelurahan[i].pasien[4].no_pasien;

          var umur1 = kelurahan[i].pasien[0] == null ? '' : kelurahan[i].pasien[0].umur;
          var umur2 = kelurahan[i].pasien[1] == null ? '' : kelurahan[i].pasien[1].umur;
          var umur3 = kelurahan[i].pasien[2] == null ? '' : kelurahan[i].pasien[2].umur;
          var umur4 = kelurahan[i].pasien[3] == null ? '' : kelurahan[i].pasien[3].umur;
          var umur5 = kelurahan[i].pasien[4] == null ? '' : kelurahan[i].pasien[4].umur;

          var jkel1 = kelurahan[i].pasien[0] == null ? '' : kelurahan[i].pasien[0].jkel;
          var jkel2 = kelurahan[i].pasien[1] == null ? '' : kelurahan[i].pasien[1].jkel;
          var jkel3 = kelurahan[i].pasien[2] == null ? '' : kelurahan[i].pasien[2].jkel;
          var jkel4 = kelurahan[i].pasien[3] == null ? '' : kelurahan[i].pasien[3].jkel;
          var jkel5 = kelurahan[i].pasien[4] == null ? '' : kelurahan[i].pasien[4].jkel;

          var hasil1 = kelurahan[i].pasien[0] == null ? '' : kelurahan[i].pasien[0].hasil;
          var hasil2 = kelurahan[i].pasien[1] == null ? '' : kelurahan[i].pasien[1].hasil;
          var hasil3 = kelurahan[i].pasien[2] == null ? '' : kelurahan[i].pasien[2].hasil;
          var hasil4 = kelurahan[i].pasien[3] == null ? '' : kelurahan[i].pasien[3].hasil;
          var hasil5 = kelurahan[i].pasien[4] == null ? '' : kelurahan[i].pasien[4].hasil;

          //console.log(kelurahan[i].pasien[0] == null ? '' : kelurahan[i].pasien[0].no_pasien)
        var PopUp = '<strong>KELURAHAN : '+kelurahan[i].nama+'</strong>\
         <table border=1 cellpadding=5 cellspacing=5>\
         <tr>\
          <th>No</th>\
          <th>No Pasien</th>\
          <th>Umur</th>\
          <th>Jkel</th>\
          <th>Hasil</th>\
        </tr>\
        <tr>\
          <td>1</td>\
          <td>'+nop1+'</td>\
          <td>'+umur1+'</td>\
          <td>'+jkel1+'</td>\
          <td>'+hasil1+'</td>\
        </tr>\
        <tr>\
          <td>2</td>\
          <td>'+nop2+'</td>\
          <td>'+umur2+'</td>\
          <td>'+jkel2+'</td>\
          <td>'+hasil2+'</td>\
        </tr>\
        <tr>\
          <td>3</td>\
          <td>'+nop3+'</td>\
          <td>'+umur3+'</td>\
          <td>'+jkel3+'</td>\
          <td>'+hasil3+'</td>\
        </tr>\
        <tr>\
          <td>4</td>\
          <td>'+nop4+'</td>\
          <td>'+umur4+'</td>\
          <td>'+jkel4+'</td>\
          <td>'+hasil4+'</td>\
        </tr>\
        <tr>\
          <td>5</td>\
          <td>'+nop5+'</td>\
          <td>'+umur5+'</td>\
          <td>'+jkel5+'</td>\
          <td>'+hasil5+'</td>\
        </tr>\
        </table>\
        <strong>KONFIRMASI : '+kelurahan[i].konfirmasi+' Orang</strong><br/>\
        <strong>SUSPECT : '+kelurahan[i].suspect+' Orang</strong><br/>\
        <strong>PROBABLE : '+kelurahan[i].probable+' Orang</strong><br/>\
        <a href="/data/pasien/'+kelurahan[i].id+'" class="btn btn-xs btn-default">Selengkapnya...</a>';
          
            L.marker([kelurahan[i].lat, kelurahan[i].long],{icon:greenIcon}).addTo(map).bindPopup(PopUp);
        };
</script>
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
        var dates = {!!json_encode($data['tanggal'])!!}
        var konfirmasi = {!!json_encode($data['konfirmasi'])!!}
        var suspect = {!!json_encode($data['suspect'])!!}
        var probable = {!!json_encode($data['probable'])!!}
        console.log(dates);
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: dates,
          datasets: [
            {
              label: 'KONFIRMASI',
              fill: false,
              data: konfirmasi,
              borderColor: [
                  'rgba(26, 193, 185, 1)'
              ],
              borderWidth: 2
            },{
              label: 'SUSPECT',
              fill: false,
              data: suspect,
             
              borderColor: [
                  'rgba(0, 143, 24, 1)'
              ],
              borderWidth: 2
            },{
              label: 'PROBABLE',
              fill: false,
              data: probable,
             
              borderColor: [
                  'rgba(143, 0, 0, 1)'
              ],
              borderWidth: 2
            },
          
          ]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
  </script>

@endpush