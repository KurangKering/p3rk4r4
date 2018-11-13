<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstPerkara extends Model
{
    protected $table = 'mst_perkara';
    protected $fillable = ['nama', 'biaya'];

    public function mst_uraian()
	{
		return $this->hasMany('App\MstUraian');
	}

	public function trans_perkara()
	{
		return $this->hasMany('App\TransPerkara');
	}
}
