@extends('layouts.template')
@section('content')
<!-- Page-Title -->
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <div class="btn-group pull-right">
        <button class="btn btn-primary" onclick="location.href='{{ route('mst_perkara.create') }}'">Tambah Perkara</button>
      </div>
      <h4 class="page-title">Data Perkara</h4>
    </div>
  </div>
</div>
<!-- end page title end breadcrumb -->
<div class="row">
  <div class="col-sm-12">
    <div class="card-box">

      <div class="table-responsive">
        <table id="tbl-perkara"  class="table table-striped">
          <thead>
           <tr>
             <th>Nama Perkara</th>
             <th>Biaya Perkara</th>
             <th width="1%">Action</th>
           </tr>
         </thead>
         <tbody>
           @foreach ($perkaras as $perkara)
           <tr>
             <td>{{ $perkara->nama }}</td>
             <td>{{ rupiah($perkara->biaya) }}</td>
             <td style="white-space: nowrap">
              <a class="btn btn-primary" href="{{ route('mst_perkara.edit',$perkara->id) }}">Edit</a>
              <a class="btn btn-danger" onclick="deletePerkara('{{ $perkara->id }}')">Delete</a>
              
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
  let $table= $("#tbl-perkara").DataTable();

  let deletePerkara = function(id) {
    swal({
      icon : 'warning',
      title : 'Hapus Perkara!',
      text : 'yakin ingin menghapus Perkara ini ?',
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
        axios.post('{{ route('mst_perkara.index') }}' + '/' + id, {

          _method : 'DELETE',
          _token : '{{ csrf_token() }}'
        })
        .then(resp => {
          location.href = '{{ request()->fullUrl() }}';
        })
        .catch(err => {
          console.log(err);
        })
      }

    });
  }

  
</script>
@endsection