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

      <h4 class="page-title">Tambah Uraian Perkara</h4>
    </div>
  </div>
</div>
<!-- end page title end breadcrumb -->
@include('trans_perkara.div_detail_perkara')

<div class="row">
 <!-- end col -->



 <div class="col-lg-12 ">

  <div class="panel" id="panel-focus">
    <div class="panel-heading">
      <h4>Form Tambah Uraian</h4>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
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
           <form action="{{ route('trans_perkara.store_uraian') }}" method="POST" class="form" id="frm-uraian">
            @csrf
            <input type="hidden" name="trans_perkara_id" value="{{ $transaksi->id }}">
            <div class="form-group">
              <label for="" class="control-label">Tanggal</label>
              <input type="date" class="form-control"  value="{{ date('Y-m-d') }}" name="tanggal_bayar">
            </div>
            <div class="form-group">
              <label for="" class="control-label">Jenis Transaksi</label>
              <select name="mst_jenis_transaksi_id" id="" class="form-control">
                @foreach ($mst_jenis_transaksi as $jenis)
                <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="" class="control-label">Jumlah Bayar</label>
              <input type="number" class="form-control" name="jumlah_bayar">
            </div>
            <div class="form-group">
              <label for="" class="control-label">Uraian</label>
              <input type="text" class="form-control" name="uraian">
            </div>
            
            <div class="form-group text-center">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </form>

          
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

@endsection
@section('custom_js')
<script>
$('html, body').animate({scrollTop: $("#panel-focus").offset().top}, 'slow');
</script>
@endsection