<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstJenisTransaksi extends Model
{
	protected $table = 'mst_jenis_transaksi';
	protected $fillable = ['nama'];


	public function mst_uraian()
	{
		return $this->hasMany('App\MstUraian');
	}

		public function trans_perkara_det()
	{
		return $this->hasMany('App\TransPerkaraDet');
	}
}
