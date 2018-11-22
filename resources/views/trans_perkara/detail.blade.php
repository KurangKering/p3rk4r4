@extends('layouts.template')

@section('custom_css')
<style>
#table-detail th {
  text-align: center;
}
#table-data {
  border: 1px ;
  font-size: 16px;
  font-family: Helvetica;
}
#table-data th {

}
.borderless td, .borderless th{
  border: none;
}
</style>
@endsection



@section('content')
<!-- Page-Title -->
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">

      <h4 class="page-title">Detail Perkara</h4>
    </div>
  </div>
</div>
@include('trans_perkara.div_detail_perkara')

<div class="row">


  <div class="col-lg-12">
    <div class="panel" id="panel-focus">
      <div class="panel-heading">
        <div class="pull-right">

          <button type="button" onclick="window.open('{{ route('trans_perkara.cetak_trans_perkara', $transaksi->id) }}')" class="btn btn-success">Cetak</button>

          @role('Administrator')

          <button type="button" onclick="location.href='{{ route('trans_perkara.create_uraian', $transaksi->id) }}'" class="btn btn-primary">Tambah Transaksi</button>
          @endrole

        </div>

        <h4 class="m-t-0">Data Uraian</h4>

      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table id="table-detail" class="table  table-bordered table-hover">
          <thead>
            <tr>
              <th rowspan="2" width="1%">No</th>
              <th rowspan="2">Tanggal</th>
              <th rowspan="2">Uraian</th>
              <th colspan="{{ count($mst_jenis_transaksi) }}" class="text-center">JUMLAH</th>
              @role('Administrator')
              <th rowspan="2" width="1%">Action</th>
              @endrole
            </tr>
            @foreach ($mst_jenis_transaksi as $jenis)
            <th>{{ $jenis->nama }}</th>
            @endforeach
          </thead>
          <tbody>
            @php $no = 1; @endphp
            @foreach ($transaksi->trans_perkara_det as $detail)
            <tr>
              <td class="text-nowrap text-center">{{ $no++ }}</td>
              <td>{{ indonesian_date($detail->tanggal_bayar, 'j F Y') }}</td>
              <td>{{ $detail->uraian }}</td>
              @foreach ($mst_jenis_transaksi as $jenis)
              <td>{{ $jenis->id == $detail->mst_jenis_transaksi->id ? rupiah($detail->jumlah_bayar) : '-'}}</td>

              @endforeach
              @role('Administrator')

              <td class="text-nowrap">
                <a href="{{ route('trans_perkara.edit_uraian', $detail->id) }}" class="btn btn-info">Edit</a>
                <a  onclick="deleteDetail('{{  $detail->id }}')" class="btn btn-danger">Delete</a>
              </td>     
              @endrole
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" class="text-right"><b>TOTAL</b></td>
              <td>{{ rupiah($transaksi->jumlah_penerimaan) }}</td>
              <td>{{ rupiah($transaksi->jumlah_pengeluaran) }}</td>
              @role('Administrator')

              <td></td>
              @endrole
            </tr>
          </tfoot>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('custom_js')
<script>
  let deleteDetail = function(id) {
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
        axios.post('{{ route('trans_perkara.destroy_uraian') }}', {
          id : id,
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