@extends('layouts.app')

@push('css') 

@endpush

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="card card-info card-outline">
      <div class="card-header">
        <h5 class="card-title m-0"> <i class="fas fa-key"></i> Login Aplikasi </h5>
      </div>
      <form method="POST" action="/login">
        @csrf
      <div class="card-body">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="username" placeholder="username" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
        </div>
        <div class="form-group row">
          <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-sm btn-block bg-gradient-primary">Log In</button>
                <a href="/" class="btn btn-sm btn-block bg-gradient-secondary">Home</a>
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

@endpush