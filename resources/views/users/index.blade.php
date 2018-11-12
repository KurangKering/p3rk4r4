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

      <table id="tbl-user"  class="table table-striped">
        <thead>
         <tr>
           <th>Nama</th>
           <th>Email</th>
           <th>Roles</th>
           <th>Action</th>
         </tr>
       </thead>
       <tbody>
         @foreach ($data as $key => $user)
         <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            {{ $v }}
            @endforeach
            @endif
          </td>
          <td style="white-space: nowrap; width: 1%">
            @if (Auth::check())
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>

            @if (! (Auth::user()->id == $user->id))
            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endif
            @endif

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>



  </div> <!-- end card-box -->
</div> <!-- end col -->
</div>

@endsection
@section('custom_js')
<script>
  let $table    = $("#tbl-user").DataTable();
</script>
@endsection