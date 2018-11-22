@extends('layouts.template')
@section('content')
<!-- Page-Title -->
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <div class="btn-group pull-right">
        <button class="btn btn-primary" onclick="location.href='{{ route('mst_uraian.create') }}'">Tambah Uraian</button>
      </div>
      <h4 class="page-title">Data Uraian</h4>
    </div>
  </div>
</div>
<!-- end page title end breadcrumb -->
<div class="row">
  <div class="col-sm-12">
    <div class="card-box">

      <div class="table-responsive">
        <table id="tbl-uraian"  class="table table-striped">
        <thead>
         <tr>
           <th>Nama Uraian</th>
           <th>Jenis Transaksi</th>
           <th>Jenis Perkara</th>
           <th width="1%">Action</th>
         </tr>
       </thead>
       <tbody>
         @foreach ($uraians as $uraian)
         <tr>
           <td>{{ $uraian->nama }}</td>
           <td>{{ $uraian->mst_jenis_transaksi->nama }}</td>
           <td>{{ $uraian->mst_perkara->nama }}</td>
           <td style="white-space: nowrap">
            <a class="btn btn-primary" href="{{ route('mst_uraian.edit',$uraian->id) }}">Edit</a>
            <a class="btn btn-danger" onclick="deleteUraian('{{ $uraian->id }}')">Delete</a>
            
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
  let $table= $("#tbl-uraian").DataTable();

  let deleteUraian = function(id) {
    swal({
      icon : 'warning',
      title : 'Hapus Uraian!',
      text : 'yakin ingin menghapus Uraian ini ?',
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
        axios.post('{{ route('mst_uraian.index') }}' + '/' + id, {

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