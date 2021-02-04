@extends('layouts.app_admin')

@push('css') 

@endpush

@section('content')

  <div class="row">
      <div class="col-md-6">
          
        <h5 class="mb-2"><i class="fas fa-virus"></i> Data Covid-19 Tanggal {{\Carbon\Carbon::today()->subDay(2)->format('d M Y')}}</h5>
        <div class="col-md-12 col-sm-12 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">KONFIRMASI</span>
            <span class="info-box-number">{{konfirmasiSubDay2()}} pasien</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-12 col-sm-12 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="far fa-user"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">SUSPECT</span>
            <span class="info-box-number">{{suspectSubDay2()}} pasien</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-12 col-sm-12 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="far fa-user"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">PROBABLE</span>
            <span class="info-box-number">{{probableSubDay2()}} pasien</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
      </div>
      
      <div class="col-md-6">
        <h5 class="mb-2"><i class="fas fa-virus"></i> Data Covid-19 Tanggal {{\Carbon\Carbon::today()->subDay(1)->format('d M Y')}}</h5>
            <div class="col-md-12 col-sm-12 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>
    
                <div class="info-box-content">
                <span class="info-box-text">KONFIRMASI</span>
                <span class="info-box-number">{{konfirmasiSubDay1()}} pasien 
                    
                    @if(konfirmasiSubDay2() == 0 )
                    (<i class="fas fa-arrow-up"></i> 100%)
                    @elseif (konfirmasiSubDay1() > konfirmasiSubDay2())
                    (<i class="fas fa-arrow-up"> </i> {{round(abs(konfirmasiPersen()))}}%)                        
                    @elseif(konfirmasiSubDay1() < konfirmasiSubDay2())
                    (<i class="fas fa-arrow-down"> </i>{{round(abs(konfirmasiPersen()))}}%)
                    @elseif(konfirmasiSubDay2() == konfirmasiSubDay1())
                    (0 %)

                    @else
                    -
                    @endif
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-12 col-sm-12 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-user"></i></span>
    
                <div class="info-box-content">
                <span class="info-box-text">SUSPECT</span>
                <span class="info-box-number">{{suspectSubDay1()}} pasien 
                    
                    @if(suspectSubDay2() == 0 )
                    (<i class="fas fa-arrow-up"></i> 100%)
                    @elseif (suspectSubDay1() > suspectSubDay2())
                    (<i class="fas fa-arrow-up"> </i> {{round(abs(suspectPersen()))}}%)                        
                    @elseif(suspectSubDay1() < suspectSubDay2())
                    (<i class="fas fa-arrow-down"> </i>{{round(abs(suspectPersen()))}}%)
                    @elseif(suspectSubDay2() == suspectSubDay1())
                    (0 %)

                    @else
                    -
                    @endif
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-12 col-sm-12 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-user"></i></span>
    
                <div class="info-box-content">
                <span class="info-box-text">PROBABLE</span>
                <span class="info-box-number">{{probableSubDay1()}} pasien
                    
                    @if(probableSubDay2() == probableSubDay1())
                    (0 %)
                    @elseif(probableSubDay2() == 0 )
                    (<i class="fas fa-arrow-up"></i> 100%)
                    @elseif (probableSubDay1() > probableSubDay2())
                    (<i class="fas fa-arrow-up"> </i> {{round(abs(probablePersen()))}}%)                        
                    @elseif(probableSubDay1() < probableSubDay2())
                    (<i class="fas fa-arrow-down"> </i>{{round(abs(probablePersen()))}}%)
                    @else
                    -
                    @endif
                    
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
      </div>
    <!-- /.col -->
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


<div class="row">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="card-title m-0"> <i class="fas fa-file"></i> Report Data Wilayah Dan Data Pasien </h5>
        </div>
        <div class="card-body">
            <a href="/report/kelurahan" class="btn btn-info btn-block"><i class="fas fa-print"></i> Cetak Data Akumulasi</a>
            <br/><br/>

            <form method="POST" action="/report/kelurahan/search">
                @csrf
                <strong>Pilih Kelurahan :</strong>
                <select class="form-control" name="kelurahan_id" required>
                    <option value="">-Pilih-</option>
                    @foreach (\App\Kelurahan::get() as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                    @endforeach
                </select><br/>
            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-print"></i> Cetak</button>
            </form>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
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