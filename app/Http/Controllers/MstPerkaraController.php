<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstPerkara;
class MstPerkaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $perkaras = MstPerkara::get();
        return view('mst_perkara.index', compact('perkaras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mst_perkara.create');  
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
            'nama' => 'required',
            'biaya' => 'required|numeric',
            
        ]);

        $newMstPerkara = MstPerkara::create([
            'nama' => $request->get('nama'),
            'biaya' => $request->get('biaya'),
        ]);
        return redirect(route('mst_perkara.index'))->with(['success' => true, 'msg' => 'Berhasil Menambah Data Perkara']);
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
        $perkara = MstPerkara::findOrFail($id);
        return view('mst_perkara.edit', compact('perkara'));
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
            'nama' => 'required',
            'biaya' => 'required|numeric',

        ]);

        $editPerkara = MstPerkara::findOrFail($id);
        $editPerkara->nama = $request->get('nama');
        $editPerkara->biaya = $request->get('biaya');
        $editPerkara->save();

        return redirect(route('mst_perkara.index'))->with(['success' => true, 'msg' => 'Berhasil Merubah Data Perkara']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perkara = MstPerkara::findOrFail($id);
        $perkara->delete();

        return response()->json(['success' => true, 'msg' => 'Berhasil Menghapus Data Perkara']);
    }
}
