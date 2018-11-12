@extends('layouts.template')
@section('content')
<!-- Page-Title -->
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <div class="btn-group pull-right">
        <button class="btn btn-primary" onclick="location.href='{{ route('users.create') }}'">Tambah Pengguna</button>
      </div>
      <h4 class="page-title">Pengguna</h4>
    </div>
  </div>
</div>
<!-- end page title end breadcrumb -->
<div class="row">
  <div class="col-sm-12">
    <div class="card-box">


      @if (count($errors) > 0)

      <div class="alert alert-danger">

        <strong>Ooops!</strong> Ada Kesalahan.<br><br>

        <ul>

         @foreach ($errors->all() as $error)

         <li>{{ $error }}</li>

         @endforeach

       </ul>

     </div>

     @endif
     <div class="ibox float-e-margins">
      <div class="ibox-content">


        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <strong>Username:</strong>

              {!! Form::text('username', null, array('placeholder' => 'Username','class' => 'form-control')) !!}

            </div>

          </div>

          <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <strong>Name:</strong>

              {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}

            </div>

          </div>

          <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <strong>Email:</strong>

              {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}

            </div>

          </div>

          <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <strong>Password:</strong>

              {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}

            </div>

          </div>

          <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <strong>Confirm Password:</strong>

              {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}

            </div>

          </div>

          <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <strong>Role:</strong>

              {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control')) !!}

            </div>

          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 text-center">

            <button type="submit" class="btn btn-primary">Submit</button>

          </div>

        </div>

        {!! Form::close() !!}
        
      </div>
    </div>




  </div> <!-- end card-box -->
</div> <!-- end col -->
</div>

@endsection
@section('custom_js')
<script>
  let $table= $("#tbl-user").DataTable();
</script>
@endsection