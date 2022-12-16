<?php

namespace App\Http\Controllers;

use App\Models\pembukuan;
use App\Models\barang;
use App\Models\katbarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PembukuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = DB::table('katbarangs')
                ->join('barangs','katbarangs.id','=','barangs.id_kategori')
                ->join('pembukuans','barangs.id','=','pembukuans.id_barang')
                ->get();

        // dd($barang);
        return view('admin.pembukuan.index',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = DB::table('barangs')->get();
        return view('admin.pembukuan.create',compact('barang'));
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
            "id_barang"=>"required",
            "status"=>"required",
            "jumlah"=>"required"
        ]);

        $input = $request->all();

        $input['bulan'] = date('m');

        $jmlh_barang = barang::find($input['id_barang']);

        $jmlh_sebelum = $jmlh_barang['total_stok'];

        if ($input['status'] == 'masuk') {
            $jmlh_now = $jmlh_sebelum + $input['jumlah'];
        }
        elseif ($input['status'] == 'keluar'){
            $jmlh_now = $jmlh_sebelum - $input['jumlah'];
        }
        else{
            redirect()->back()->with('success','salah pilih status');
        }

        $jmlh_barang->update(['total_stok'=>$jmlh_now]);
        pembukuan::create($input);

        return redirect('admin/pembukuan')->with('success','berhasil input data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pembukuan  $pembukuan
     * @return \Illuminate\Http\Response
     */
    public function show(pembukuan $pembukuan)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pembukuan  $pembukuan
     * @return \Illuminate\Http\Response
     */
    public function edit(pembukuan $pembukuan,$id)
    {
        $selected = pembukuan::find($id);
        $nama_barang_selected = barang::where('id',$selected->id_barang)->first();
        $barang = DB::table('barangs')
                    ->where('id','!=',$selected->id_barang)
                    ->get();
        // dd($barang);
        return view('admin.pembukuan.edit',compact('barang','selected','nama_barang_selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pembukuan  $pembukuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pembukuan $pembukuan,$id)
    {
        $this->validate($request,[
            "id_barang"=>"required",
            "status"=>"required",
            "jumlah"=>"required"
        ]);

        $input = $request->all();
        $update = pembukuan::find($id);
        $total_berubah = barang::find($input['id_barang']);
        $jumlah_sebelum = $update->jumlah;
        $jumlah_sesudah = $request->jumlah;
        // dd($total_berubah);
        if ($request->status == 'masuk'){
            # nanti total - jumlah_sebelum + jumlah_sesudah
            $new_value = $total_berubah['total_stok'] - $jumlah_sebelum + $jumlah_sesudah;
        }
        elseif ($request->status == 'keluar'){
            # nanti total - jumlah_sebelum - jumlah_sesudah
            $new_value = $total_berubah['total_stok'] - $jumlah_sebelum + $jumlah_sesudah;
        }

        // dd($new_value);
        $total_berubah->update(['total_stok'=>$new_value]);
        #untuk bagian pembukuan
        $update->fill($input)->save();
        #untuk bagian total barang


        return redirect('/admin/pembukuan')->with('success','berhasil edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pembukuan  $pembukuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pembukuan $pembukuan, $id)
    {
        $destroy = pembukuan::find($id);
        $change_total = barang::find($destroy['id_barang']);
        // dd($change_total);

        if ($destroy['status'] == 'masuk'){
            # nanti total = total - jumlah
            $perubahan = $change_total['total_stok'] - $destroy['jumlah'];
        }
        elseif ($destroy['status'] == 'keluar'){
            # nanti total = total + jumlah
            $perubahan = $change_total['total_stok'] + $destroy['jumlah'];
        }

        $change_total->update(['total_stok'=>$perubahan]);
        $destroy->delete();

        return redirect('/admin/pembukuan')->with('success','berhasil delete pembukuan');
    }
}
