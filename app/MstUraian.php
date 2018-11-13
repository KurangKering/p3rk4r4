<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstUraian extends Model
{
	protected $table = 'mst_uraian';
	protected $fillable = ['nama', 'mst_jenis_transaksi_id', 'mst_perkara_id'];

	public function mst_perkara()
	{
		return $this->belongsTo('App\MstPerkara');
	}

	public function mst_jenis_transaksi()
	{
		return $this->belongsTo('App\MstJenisTransaksi');
	}

	
}
