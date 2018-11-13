<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransPerkaraDet extends Model
{
	protected $table = 'trans_perkara_det';
	protected $dates = ['tanggal_bayar'];
	protected $fillable = ['jumlah_bayar', 'tanggal_bayar', 'trans_perkara_id', 'mst_uraian_id', 'uraian', 'mst_jenis_transaksi_id'];

	public function trans_perkara()
	{
		return $this->belongsTo('App\TransPerkara');
	}

	

	public function mst_jenis_transaksi()
	{
		return $this->belongsTo('App\MstJenisTransaksi');
	}

	

}
