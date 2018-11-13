@extends('layouts.template')
@section('content')
<!-- Page-Title -->
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <div class="btn-group pull-right">

      </div>
      <h4 class="page-title">Ubah Transaksi Perkara</h4>
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

     <form action="{{ route('trans_perkara.update', $transaksi->id) }}" method="POST" class="form">
      @csrf

      {{ method_field("PATCH") }}
      <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
          <div class="form-group">
            <label for="" class="control-label">No Perkara</label>
            <input type="text" class="form-control" name="no_perkara" value="{{ $transaksi->no_perkara }}">          
          </div>
          <div class="form-group">
            <label for="" class="control-label">Nama Perkara</label>
            <select name="mst_perkara_id" id="mst_perkara_id" class="form-control">
              @foreach ($mst_perkara as $perkara)
              <option value="{{ $perkara->id }}"

                @if ($perkara->id == $transaksi->mst_perkara_id)
                selected
                @endif

                >{{ $perkara->nama }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="" class="control-label">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" value="{{ $transaksi->tanggal->toDateString() }}">          
            </div>
            <div class="form-group">
              <label for="" class="control-label">Penggugat</label>
              <select name="penggugat_user_id" id="penggugat_user_id" class="form-control">
                @foreach ($penggugats as $penggugat)
                <option value="{{ $penggugat->id }}"
                  @if ($penggugat->id == $transaksi->penggugat_user_id)
                  selected
                  @endif
                  >{{ $penggugat->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="" class="control-label">Tergugat</label>
                <input type="text" class="form-control" name="tergugat" value="{{ $transaksi->tergugat }}">          
              </div>

              <div class="form-group">
                <label for="" class="control-label">Status</label>
                <select name="status" id="status" class="form-control">

                  @foreach (Config::get('enums.status_perkara') as $key => $status)
                  <option value="{{ $key }}"
                  @if ($key == $transaksi->status)
                  selected
                  @endif
                  >{{ $status }}</option>
                  @endforeach
                </select>
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