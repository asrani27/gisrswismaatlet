@extends('layouts.app')

@push('css') 
<!-- DataTables -->
<link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endpush

@section('content')
<a href="/" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i>&nbsp; Kembali</a>
 <br /><br />
<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0"> <i class="fas fa-server"></i> Data Pasien </h5>
      </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped table-sm">
            <thead>
            <tr class="bg-gradient-info">
                <th class="text-center">No</th>
                <th class="text-center">No Pasien</th>
                <th class="text-center">Umur</th>
                <th class="text-center">Jkel</th>
                <th class="text-center">Hasil</th>
                <th class="text-center">Kelurahan</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $no =1;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{$no++}}</td>
                        <td class="text-center">{{$item->no_pasien}}</td>
                        <td class="text-center">{{$item->umur}} Tahun</td>
                        <td class="text-center">{{$item->jkel}}</td>
                        <td class="text-center">{{$item->hasil}}</td>
                        <td class="text-center">{{$item->kelurahan == null ? '' :$item->kelurahan->nama}}</td>
                    </tr>
                @endforeach
            
            </tbody>
            </table>
        </div>
    </div>
  </div>
  <!-- /.col-md-6 -->
</div>

@endsection

@push('js')
<!-- DataTables -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endpush