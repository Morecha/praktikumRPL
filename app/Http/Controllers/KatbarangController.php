<?php

namespace App\Http\Controllers;

use App\Models\katbarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KatbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('katbarangs')->get();
        // dd($data);
        return view('admin.katbarang.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.katbarang.create');
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
            "kategori"=>"required"
        ]);

        $input = $request->all();

        $log = katbarang::create($input);

        activity()
        ->withProperties([])
        ->causedBy(auth()->user())
        ->performedOn($log)
        ->log('You have created Kategori Barang');

        return redirect('/admin/katbarang')->with('success','Berhasi Create New Kategories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\katbarang  $katbarang
     * @return \Illuminate\Http\Response
     */
    public function show(katbarang $katbarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\katbarang  $katbarang
     * @return \Illuminate\Http\Response
     */
    public function edit(katbarang $katbarang,$id)
    {
        $update = katbarang::find($id);
        // dd($update);
        return view('admin.katbarang.edit',compact('update'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\katbarang  $katbarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, katbarang $katbarang, $id)
    {
        $update = katbarang::find($id);

        $this->validate($request,[
            "kategori"=>"required"
        ]);

        $input = $request->all();

        $update->fill($input)->save();

        activity()
        ->withProperties([])
        ->causedBy(auth()->user())
        ->performedOn($update)
        ->log('You have Edit Kategori Barang');

        return redirect('/admin/katbarang')->with('success','Berhasi Edit Kategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\katbarang  $katbarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(katbarang $katbarang, $id)
    {
        $delete = katbarang::find($id);
        $delete->delete();

        activity()
        ->withProperties([])
        ->causedBy(auth()->user())
        ->performedOn($delete)
        ->log('You have Delete Kategori Barang');

        return redirect('/admin/katbarang')->with('success','Berhasi Delete Kategories');
    }
}
