@extends('layouts.template')
@section('content')
<!-- Page-Title -->
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <div class="btn-group pull-right">
        <button class="btn btn-primary" onclick="location.href='{{ route('trans_perkara.create') }}'">Tambah Perkara</button>
      </div>
      <h4 class="page-title">Transaksi Perkara</h4>
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
             <th>No Perkara</th>
             <th>Tanggal</th>
             <th>Perkara</th>
             <th>Penggugat</th>
             <th>Tergugat</th>
             <th>Saldo</th>
             <th>Status</th>
             <th width="1%">Action</th>
           </tr>
         </thead>
         <tbody>
           @foreach ($trans as $transaksi)
           <tr>
             <td>{{ $transaksi->no_perkara }}</td>
             <td>{{ indonesian_date($transaksi->tanggal, 'd-m-Y') }}</td>
             <td>{{ $transaksi->mst_perkara->nama }}</td>
             <td>{{ $transaksi->penggugat->name }}</td>
             <td>{{ $transaksi->tergugat }}</td>
             <td>{{ rupiah($transaksi->sisa_saldo) }}</td>
             <td>{{ Config::get('enums.status_perkara')[$transaksi->status] ?? '' }}</td>
             <td style="white-space: nowrap">
              <a onclick="window.open('{{ route('trans_perkara.cetak_trans_perkara', $transaksi->id) }}')" class="btn btn-success">Cetak</a>

              <a class="btn btn-info" href="{{ route('trans_perkara.detail',$transaksi->id) }}">Detail</a>
              <a class="btn btn-primary" href="{{ route('trans_perkara.edit',$transaksi->id) }}">Edit</a>
              <a class="btn btn-danger" onclick="deletePerkara('{{ $transaksi->id }}')">Delete</a>

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
        axios.post('{{ route('trans_perkara.index') }}' + '/' + id, {

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