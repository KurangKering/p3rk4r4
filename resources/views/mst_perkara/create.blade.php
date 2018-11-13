@extends('layouts.template')
@section('content')
<!-- Page-Title -->
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <div class="btn-group pull-right">

      </div>
      <h4 class="page-title">Tambah Data Perkara</h4>
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

      <form action="{{ route('mst_perkara.store') }}" method="POST" class="form">
        @csrf

        <div class="row">
          <div class="col-lg-6 col-lg-offset-3">
          <div class="form-group">
            <label for="" class="control-label">Nama Perkara</label>
            <input type="text" class="form-control" name="nama">          
          </div>
          <div class="form-group">
            <label for="" class="control-label">Biaya Perkara</label>
            <input type="number" class="form-control" name="biaya">          
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