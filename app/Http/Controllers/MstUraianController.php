<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstUraian;
use App\MstPerkara;
use App\MstJenisTransaksi;
class MstUraianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $uraians = MstUraian::with('mst_perkara', 'mst_jenis_transaksi')->get();
        return view('mst_uraian.index', compact('uraians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mst_perkara = MstPerkara::get();
        $mst_jenis_transaksi = MstJenisTransaksi::get();
        $uraians = MstUraian::get();
        return view('mst_uraian.create', compact('mst_perkara', 'mst_jenis_transaksi', 'uraians'));
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
            'mst_perkara_id' => 'required',
            'mst_jenis_transaksi_id' => 'required',
            'uraian' => 'required',
        ]);

        $newUraian = MstUraian::create([
            'nama' => $request->get('uraian'),
            'mst_perkara_id' => $request->get('mst_perkara_id'),
            'mst_jenis_transaksi_id' => $request->get('mst_jenis_transaksi_id'),
        ]);
        return redirect(route('mst_uraian.index'))->with(['success' => true, 'msg' => 'Berhasil Menambah Uraian']);

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
      $mst_jenis_transaksi = MstJenisTransaksi::get();
      $uraian = MstUraian::findOrFail($id);
      return view('mst_uraian.edit', compact('mst_perkara', 'mst_jenis_transaksi', 'uraian'));
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
            'mst_perkara_id' => 'required',
            'mst_jenis_transaksi_id' => 'required',
            'uraian' => 'required',
        ]);

        $editUraian = MstUraian::findOrFail($id);
        $editUraian->nama = $request->get('uraian');
        $editUraian->mst_perkara_id = $request->get('mst_perkara_id');
        $editUraian->mst_jenis_transaksi_id = $request->get('mst_jenis_transaksi_id');

        $editUraian->save();


        return redirect(route('mst_uraian.index'))->with(['success' => true, 'msg' => 'Berhasil Merubah Data Uraian']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uraian = MstUraian::findOrFail($id);
        $uraian->delete();

        return response()->json(['success' => true, 'msg' => 'Berhasil Menghapus Data Uraian']);
    }
}
