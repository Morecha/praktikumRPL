<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\katbarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = DB::table('katbarangs')
                ->join('barangs','katbarangs.id','=','barangs.id_kategori')->get();
        // dd($barang);
        return view('admin.barang.index',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = katbarang::orderby('id')->get();
        return view('admin.barang.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama'=>'required',
            'id_kategori'=>'required'
        ]);

        $input = $request->all();
        $input['total_stok'] = 0;
        barang::create($input);

        return redirect('/admin/barang')->with('success','Berhasil Tambah Barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(barang $barang, $id)
    {
        $barang = barang::find($id);
        $kategori = katbarang::where('id',$barang->id_kategori)->first();
        $allkategori = katbarang::orderby('id')->where('id','!=',$kategori->id)->get();
        // dd($allkategori);
        return view('admin.barang.edit',compact('barang','kategori','allkategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang, $id)
    {
        $this->validate($request,[
            'nama'=>'required',
            'id_kategori'=>'required'
        ]);

        $update = barang::find($id);

        $update->update(['nama'=>$request['nama'],
                        'id_kategori'=>$request['id_kategori']]);

        return redirect('/admin/barang')->with('success','berhasil edit barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $barang, $id)
    {
        $delete = barang::find($id);
        $delete->delete();

        return redirect('/admin/barang')->with('success','berhasil delete barang');
    }
}
