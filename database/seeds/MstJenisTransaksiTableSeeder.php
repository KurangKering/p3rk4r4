<?php

use Illuminate\Database\Seeder;
use App\MstJenisTransaksi;
class MstJenisTransaksiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['Penerimaan', 'Pengeluaran'];

        foreach ($arr as $key => $jenis) {
        	MstJenisTransaksi::firstOrCreate([
        		'nama' => $jenis
        	]);
        }
    }
}
