<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransPerkara extends Model
{
	protected $table = 'trans_perkara';
	protected $dates = ['tanggal'];
	protected $fillable = ['no_perkara', 'tergugat', 'tanggal', 'penggugat_user_id', 'mst_perkara_id', 'status'];

	public function penggugat()
	{
		return $this->belongsTo('App\User', 'penggugat_user_id');
	}
	public function mst_perkara()
	{
		return $this->belongsTo('App\MstPerkara');
	}

	public function trans_perkara_det()
	{
		return $this->hasMany('App\TransPerkaraDet');
	}


}
