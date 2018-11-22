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

      <div class="table-responsive">
        <table id="tbl-user"  class="table table-striped">
          <thead>
           <tr>
             <th>Nama</th>
             <th>Username</th>
             <th>No Perkara</th>
             <th>Email</th>
             <th>Hak Akses</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
           @foreach ($data as $key => $user)
           <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->no_perkara ?? '-' }}</td>
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
    </div>



  </div> <!-- end card-box -->
</div> <!-- end col -->
</div>

@endsection
@section('custom_js')
<script>
  let $table= $("#tbl-user").DataTable();

  $('form').on('click', 'input[type="submit"]', function(e) {
    e.preventDefault();

    swal({
      icon : 'warning',
      title : 'Hapus User!',
      text : 'yakin ingin menghapus user ini ?',
      buttons : {
        'Batal' : {
          className : 'btn btn-inverse'
        },
        'Hapus' : {
          className : 'btn btn-danger'
        },
      },
      closeOnClickOutside : false
    })
    .then(clicked => {
      if (clicked == 'Hapus') {
        $(this).parent().submit();
      }

    })

    ;
    
  });
  
</script>
@endsection