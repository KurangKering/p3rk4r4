@extends('layouts.template')
@section('content')
<!-- Page-Title -->
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <div class="btn-group pull-right">

      </div>
      <h4 class="page-title">Ubah Data Uraian</h4>
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

     <form action="{{ route('mst_uraian.update', $uraian->id) }}" method="POST" class="form">
      @csrf
      {{ method_field('PATCH') }}
      <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
          <div class="form-group">
            <label for="" class="control-label">Nama Perkara</label>
            <select name="mst_perkara_id" id="" class="form-control">
              @foreach($mst_perkara as $perkara)

              <option  value="{{ $perkara->id }}"

                @if ($perkara->id == $uraian->mst_perkara->id)
                selected
                @endif
                >{{ $perkara->nama }}</option>
                @endforeach
              </select>         
            </div>
            <div class="form-group">
              <label for="" class="control-label">Jenis Transaksi</label>
              <select name="mst_jenis_transaksi_id" id="" class="form-control" >
                @foreach($mst_jenis_transaksi as $jenis)
                <option value="{{ $jenis->id }}"
                  @if ($jenis->id == $uraian->mst_jenis_transaksi_id)

                  selected
                  @endif
                  >{{ $jenis->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Uraian</label>
                <input type="text" class="form-control" name="uraian" value="{{ $uraian->nama }}">
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

  </script>
  @endsection