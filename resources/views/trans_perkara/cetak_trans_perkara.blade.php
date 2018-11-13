<html>
<head>
  <style>

  .text-justify {
    text-align: justify !important;
  }

  .text-nowrap {
    white-space: nowrap !important;
  }

  .text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .text-left {
    text-align: left !important;
  }

  .text-right {
    text-align: right !important;
  }

  .text-center {
    text-align: center !important;
  }


  .table {
    width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
  }
  .table {
    border-collapse: collapse !important;
  }


  .table-bordered {
    border: 1px solid #000;
  }


  .table-bordered th,
  .table-bordered td {
    border: 1px solid #000;
  }

  .table-bordered thead th,
  .table-bordered thead td {
    border-bottom-width: 2px;
  }


  #table-detail th, #table-detail td {
    padding: 10px;
  }

  #table-data th {
    text-align: left;

  }
  #table-data th, #table-data td {
    padding: 5px;
  }

  .heading-title {
    font-weight: bold;
    text-align: center;
    font-size: 18px;
  }


}
</style>
</head>
<body>
  <div class="print-area" style="">
    <p class="heading-title">PENGADILAN TATA USAHA NEGARA PEKANBARU
      <br>
      BUKU JURNAL KEUANGAN PERKARA BANDING
    </p>

    <table id="table-data" class="table">
      <tr>
        <th class="text-nowrap" width="1%">Nomor Perkara</th>
        <td width="1%">:</td>
        <td>{{ $transaksi->no_perkara }}</td>
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

      

    </table>


    <table id="table-detail" class="table table-bordered">
      <thead>
        <tr>
          <th rowspan="2" width="1%">No</th>
          <th rowspan="2" width="1%">Tanggal</th>
          <th rowspan="2">Uraian</th>
          <th colspan="{{ count($mst_jenis_transaksi) }}" class="text-center">JUMLAH</th>
        </tr>
        @foreach ($mst_jenis_transaksi as $jenis)
        <th width="1%">{{ $jenis->nama }}</th>
        @endforeach
      </thead>
      <tbody>
        @php $no = 1; @endphp
        @foreach ($transaksi->trans_perkara_det as $detail)
        <tr>
          <td class="text-nowrap text-center">{{ $no++ }}</td>
          <td class="text-nowrap">{{ indonesian_date($detail->tanggal_bayar, 'j F Y') }}</td>
          <td>{{ $detail->uraian }}</td>
          @foreach ($mst_jenis_transaksi as $jenis)
          <td class="text-nowrap">{{ $jenis->id == $detail->mst_jenis_transaksi->id ? rupiah($detail->jumlah_bayar) : '-'}}</td>

          @endforeach

        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="text-right"><b>TOTAL</b></td>
          <td>{{ rupiah($transaksi->jumlah_penerimaan) }}</td>
          <td>{{ rupiah($transaksi->jumlah_pengeluaran) }}</td>
        </tr>

        <tr>
          <td colspan="3" class="text-right"><b>SISA SALDO</b></td>
          <td colspan="2" class="text-center">{{ rupiah($transaksi->sisa_saldo) }}</td>
        </tr>

      </tfoot>
    </table>
  </div>
</body>
<script>
  window.print();
</script>
</html>