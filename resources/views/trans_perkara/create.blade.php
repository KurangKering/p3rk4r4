@extends('layouts.template')
@section('content')
<!-- Page-Title -->
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <div class="btn-group pull-right">

      </div>
      <h4 class="page-title">Tambah Transaksi Perkara</h4>
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

     <form action="{{ route('trans_perkara.store') }}" method="POST" class="form">
      @csrf

      <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
          <div class="form-group">
            <label for="" class="control-label">No Perkara</label>
            @role('Administrator')
            <input type="text" class="form-control" name="no_perkara" readonly>          

            @elserole('Penggugat')
            <input type="text" class="form-control" name="no_perkara" readonly value="{{ Auth::user()->no_perkara }}">          
            @endrole
          </div>
          <div class="form-group">
            <label for="" class="control-label">Nama Perkara</label>
            <select name="mst_perkara_id" id="mst_perkara_id" class="form-control">
              @foreach ($mst_perkara as $perkara)
              <option value="{{ $perkara->id }}">{{ $perkara->nama }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="" class="control-label">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}">          
          </div>
          <div class="form-group">
            <label for="" class="control-label">Penggugat</label>
            @role('Administrator')
            
            <select name="penggugat_user_id" id="penggugat_user_id" class="form-control">
              <option ></option>
              @foreach ($penggugats as $penggugat)
              <option data-no-perkara="{{ $penggugat->no_perkara }}" value="{{ $penggugat->id }}">{{ $penggugat->name }}</option>
              @endforeach
            </select>
            @elserole('Penggugat')
            <input type="hidden" name="penggugat_user_id" value="{{ Auth::user()->id }}">
            <input type="text" class="form-control" name="" readonly value="{{ Auth::user()->name }}">
            @endrole
          </div>

          <div class="form-group">
            <label for="" class="control-label">Tergugat</label>
            <input type="text" class="form-control" name="tergugat">          
          </div>

          <div class="form-group text-center">
            <button class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </form>


  </div> <!-- end card-box -->
</div> <!-- end col -->
</div>

@endsection
@section('custom_js')
<script>

  $selectPenggugat = $("select[name='penggugat_user_id']");
  $inputNoPerkara = $("input[name='no_perkara']");


  $selectPenggugat.change(function(event) {

    $option = $(this).children(':selected');

    $inputNoPerkara.val($option.data('no-perkara'));
  }); 
</script>
@endsection