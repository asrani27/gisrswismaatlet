@extends('layouts.app_admin')

@push('css') 
<!-- DataTables -->
<link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endpush

@section('content')
<a href="/pasien/add" class="btn btn-sm btn-danger"><i class="fas fa-plus"></i>&nbsp; Add Pasien</a>
<button type="button" class="btn btn-info btn-sm " data-toggle="modal" data-target="#modal-default">
  <i class="fas fa-upload"></i>
  Upload Data
</button>
<a href="/storage/format_excel.xlsx" class="btn btn-sm bg-gradient-success"><i class="fas fa-file-excel"></i>&nbsp; Downloaf Format</a>
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
                <th class="text-center">Kelurahan</th>
                <th class="text-center">#</th>
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
                        <td class="text-center">{{$item->kelurahan == null ? '' :$item->kelurahan->nama}}</td>
                        <td>
                            <a href="/pasien/edit/{{$item->id}}" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                            <a href="/pasien/delete/{{$item->id}}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data Ini?');"><i class="fas fa-trash"></i></a>
                    </tr>
                @endforeach
            
            </tbody>
            </table>
        </div>
    </div>
  </div>
  <!-- /.col-md-6 -->
</div>
<div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="post" action="/pasien/upload" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          {{-- <div class="form-group row">
            <label for="inputPassword3" class="col-sm-4 col-form-label">Tanggal Upload</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" name="tanggal_upload" required>
            </div>
          </div> --}}
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">File Excel</label>
            <div class="col-sm-9">
              <input type="file" class="form-control" name="file" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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