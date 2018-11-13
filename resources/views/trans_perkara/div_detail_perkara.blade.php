<div class="row">
  <div class="col-sm-8">

    <div class="panel">
      <div class="panel-heading">
        <div class="pull-right">
          @role('Administrator')

          <button class="btn btn-warning" onclick="location.href='{{ route('trans_perkara.edit', $transaksi->id) }}'">EDIT</button>
          @endrole
        </div>
        <h4 class="m-t-0 m-b-0">Data Perkara</h4>
      </div>
      <div class="panel-body">
        <table id="table-data" class="table borderless">
          <tr>
            <th class="text-nowrap" width="1%">No Perkara</th>
            <td width="1%">:</td>
            <td>{{ $transaksi->no_perkara }}</td>
          </tr>

          <tr>
            <th class="text-nowrap" width="1%">Perkara</th>
            <td width="1%">:</td>
            <td>{{ $transaksi->mst_perkara->nama }}</td>
          </tr>
          <tr>
            <th class="text-nowrap" width="1%">Pembanding</th>
            <td width="1%">:</td>
            <td>{{ $transaksi->penggugat->name }}</td>
          </tr>
          <tr>
            <th class="text-nowrap" width="1%">Terbanding</th>
            <td width="1%">:</td>
            <td>{{ $transaksi->tergugat }}</td>
          </tr>

          <tr>
            <th class="text-nowrap" width="1%">Status</th>
            <td width="1%">:</td>
            <td>{{ Config::get('enums.status_perkara')[$transaksi->status] ?? '' }}</td>
          </tr>

        </table>
      </div>
    </div>
    <!-- end card-box -->
  </div> <!-- end col -->

  <div class="col-lg-4">
    <div class="card-box">
      <p class="text-center">Sisa Saldo</p>
      <p class="text-center ">{{ rupiah($transaksi->sisa_saldo) }}</p>
    </div>
  </div>
</div>