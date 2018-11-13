<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransPerkara;
use App\TransPerkaraDet;
use App\MstPerkara;
use App\MstJenisTransaksi;
use App\User;
class TransPerkaraController extends Controller
{


     /**
     * url('trans_perkara/{trans_id}/cetak_trans_perkara')
     * route('trans_perkara.cetak_trans_perkara', {trans_id})
     */
     public function cetak_trans_perkara($id)
     {
        $user = \Auth::user();

        $transaksi = $this->get_data_transaksi($id);
        $mst_jenis_transaksi = MstJenisTransaksi::get();


        if ($user->hasRole('Penggugat')) {
            if ($transaksi->penggugat_user_id != $user->id) {
                abort(404);
            }
        }

        return view('trans_perkara.cetak_trans_perkara', compact('transaksi', 'mst_jenis_transaksi'));
    }
    /**
     * url('trans_perkara/{detail_id}/update_uraian')
     * route('trans_perkara.update_uraian', {detail_id})
     */
    public function update_uraian(Request $request, $id)
    {
       $this->validate($request, [
        'tanggal_bayar' => 'required',
        'mst_jenis_transaksi_id' => 'required',
        'jumlah_bayar' => 'required',
        'uraian' => 'required',
    ]);

       $editUraian = TransPerkaraDet::findOrFail($id);
       $editUraian->tanggal_bayar = $request->get('tanggal_bayar');
       $editUraian->mst_jenis_transaksi_id = $request->get('mst_jenis_transaksi_id');
       $editUraian->jumlah_bayar = $request->get('jumlah_bayar');
       $editUraian->uraian = $request->get('uraian');
       $editUraian->save();

       return redirect(route('trans_perkara.detail', $editUraian->trans_perkara_id));
   }
    /**
     * url('trans_perkara/{detail_id}/edit_uraian')
     * route('trans_perkara.edit_uraian', {detail_id})
     */
    public function edit_uraian($id)
    {
        $detail = TransPerkaraDet::findOrFail($id);
        $mst_jenis_transaksi = MstJenisTransaksi::get();

        $id_transaksi = $detail->trans_perkara_id;
        $transaksi = $this->get_data_transaksi($id_transaksi);


        return view('trans_perkara.edit_uraian', compact('transaksi', 'mst_jenis_transaksi', 'detail'));
    }

    /**
     * url('trans_perkara/destroy_uraian')
     * route('trans_perkara.destroy_uraian')
     */
    public function destroy_uraian(Request $request)
    {
        $id = $request->get('id');
        $deleteDetail = TransPerkaraDet::findOrFail($id);
        $deleteDetail->delete();

    }

    /**
     * url('trans_perkara/store_uraian')
     * route('trans_perkara.store_uraian')
     */
    public function store_uraian(Request $request)
    {
        $this->validate($request, [
            'trans_perkara_id' => 'required',
            'tanggal_bayar' => 'required',
            'mst_jenis_transaksi_id' => 'required',
            'jumlah_bayar' => 'required',
            'uraian' => 'required',
        ]);
        $newTransDet = TransPerkaraDet::create([
            'trans_perkara_id' => $request->get('trans_perkara_id'),
            'tanggal_bayar' => $request->get('tanggal_bayar'),
            'mst_jenis_transaksi_id' => $request->get('mst_jenis_transaksi_id'),
            'jumlah_bayar' => $request->get('jumlah_bayar'),
            'uraian' => $request->get('uraian'),
        ]);

        return redirect(route('trans_perkara.detail', $newTransDet->trans_perkara_id));

    }
    /**
     * url('trans_perkara/{trans_perkara_id}/create_uraian')
     */
    public function create_uraian($id)
    {
        $transaksi = $this->get_data_transaksi($id);

        $mst_jenis_transaksi = MstJenisTransaksi::get();
        return view('trans_perkara.create_uraian', compact('transaksi', 'mst_jenis_transaksi'));
    }


    /**
     * url('trans_perkara/{id}/detail')
     */
    public function det_perkara($id)
    {
        $transaksi = $this->get_data_transaksi($id);
        $mst_jenis_transaksi = MstJenisTransaksi::get();


        $user = \Auth::user();
        if ($user->hasRole('Penggugat')) {
            if ($transaksi->penggugat_user_id != $user->id) {
                abort(404);
            }
        }
        return view('trans_perkara.detail', compact('transaksi', 'mst_jenis_transaksi'));
    }

    private function get_data_transaksi($id) {
        $transaksi = TransPerkara::findOrFail($id);
        $transaksi->jumlah_penerimaan = 0;
        $transaksi->jumlah_pengeluaran = 0;

        $transaksi->trans_perkara_det->each(function($i) use($transaksi) {
            if ($i->mst_jenis_transaksi_id == 1) {
                $transaksi->jumlah_penerimaan += $i->jumlah_bayar;
            } else
            if ($i->mst_jenis_transaksi_id == 2) {
                $transaksi->jumlah_pengeluaran += $i->jumlah_bayar;
            }

        });
        $transaksi->sisa_saldo = $transaksi->jumlah_penerimaan - $transaksi->jumlah_pengeluaran;
        return $transaksi;
    }
    /**
     * url('trans_perkara/index_penggugat')
     */
    public function index_penggugat()
    {

        $user_id = \Auth::user()->id;
        $trans = TransPerkara::where('penggugat_user_id', $user_id)->get();
        $trans->each(function($i) {
          $i->trans_perkara_det->each(function($ii) use($i) {
            if ($ii->mst_jenis_transaksi_id == 1) {
                $i->jumlah_penerimaan += $ii->jumlah_bayar;
            } else
            if ($ii->mst_jenis_transaksi_id == 2) {
                $i->jumlah_pengeluaran += $ii->jumlah_bayar;
            }

        });
          $i->sisa_saldo = $i->jumlah_penerimaan - $i->jumlah_pengeluaran;

      });

        return view('trans_perkara.index_penggugat', compact('trans'));
    }

    public function index_admin()
    {

        $trans = TransPerkara::get();
        $trans->each(function($i) {
          $i->trans_perkara_det->each(function($ii) use($i) {
            if ($ii->mst_jenis_transaksi_id == 1) {
                $i->jumlah_penerimaan += $ii->jumlah_bayar;
            } else
            if ($ii->mst_jenis_transaksi_id == 2) {
                $i->jumlah_pengeluaran += $ii->jumlah_bayar;
            }

        });
          $i->sisa_saldo = $i->jumlah_penerimaan - $i->jumlah_pengeluaran;

      });

        return view('trans_perkara.index_admin', compact('trans'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $mst_perkara = MstPerkara::get();
        $penggugats = User::role('penggugat')->get();
        return view('trans_perkara.create', compact('mst_perkara', 'penggugats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'no_perkara' => 'required',
            'mst_perkara_id' => 'required',
            'tanggal' => 'required',
            'penggugat_user_id' => 'required',
            'tergugat' => 'required',
        ]);

        $newTrans = TransPerkara::create([

            'no_perkara' => $request->get('no_perkara'),
            'mst_perkara_id' => $request->get('mst_perkara_id'),
            'tanggal' => $request->get('tanggal'),
            'penggugat_user_id' => $request->get('penggugat_user_id'),
            'tergugat' => $request->get('tergugat'),
            'status' => '1',
        ]);
        $user = \Auth::user();
        $page = '/';
        if ($user->hasRole('Administrator')) {
            $page = route('trans_perkara.index_admin');
        } else 
        if ($user->hasRole('Penggugat')) {
            $page = route('trans_perkara.index_penggugat');

        }


        return redirect(url($page))->with(['success' => true, 'msg' => 'Berhasil Menambah Data Transaksi Perkara'] );


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mst_perkara = MstPerkara::get();
        $penggugats = User::role('penggugat')->get();

        $transaksi = TransPerkara::findOrFail($id);
        return view('trans_perkara.edit', compact('mst_perkara', 'penggugats', 'transaksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'no_perkara' => 'required',
            'mst_perkara_id' => 'required',
            'tanggal' => 'required',
            'penggugat_user_id' => 'required',
            'tergugat' => 'required',
            'status' => 'required',
        ]);

        $editTrans = TransPerkara::findOrFail($id);

        $editTrans->no_perkara        = $request->get('no_perkara');
        $editTrans->mst_perkara_id    = $request->get('mst_perkara_id');
        $editTrans->tanggal           = $request->get('tanggal');
        $editTrans->penggugat_user_id = $request->get('penggugat_user_id');
        $editTrans->tergugat          = $request->get('tergugat');
        $editTrans->status            = $request->get('status');
        $editTrans->save();

        return redirect(route('trans_perkara.detail', $id))->with(['success' => true, 'msg' => 'Berhasil Menambah Data Transaksi Perkara'] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trans_perkara = TransPerkara::findOrFail($id);
        $trans_perkara->trans_perkara_det->each(function($i) {
            $i->delete();
        });
        $trans_perkara->delete();

        return response()->json(['success' => true, 'msg'=> 'Berhasil Menghapus Data']);
    }

}
