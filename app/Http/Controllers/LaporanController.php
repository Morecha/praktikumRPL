<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use PDF;
use App\Models\pembukuan;
use App\Models\barang;
use App\Models\katbarang;
use App\Models\laporan;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = laporan::all();
        // dd($laporan);
        return view('admin.laporan.index',compact('laporan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.laporan.create');
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
            "bulan"=>"required",
            "tahun"=>"required"
        ]);

        $input = $request->all();
        $all_barang = barang::all();
        $all_kategori = katbarang::all();
        $all_pembukuan = pembukuan::all();

        $data = [
            'title' => 'Laporan Gudang',
            'toko'=> 'Sofi Grosir',
            'date' => date('m/d/Y')
        ];

        $end = new Carbon('last day of this month');
        $end = Carbon::parse($end)->format('Y-m-d');
        $all_barang = barang::all();
        $all_kategori = katbarang::all();
        $all_pembukuan = pembukuan::all();

        $count_barang = $all_barang->count();
        $count_kategori = $all_kategori->count();
        $count_pembukuan = $all_pembukuan->count();

        $laporan = DB::table('katbarangs')
        ->join('barangs','katbarangs.id','=','barangs.id_kategori')
        ->join('pembukuans','barangs.id','=','pembukuans.id_barang')
        ->where('pembukuans.bulan',$input['bulan'])
        ->get();

        $data = [
            'title' => 'Laporan Bulanan',
            'toko'=> 'Sofi Grosir',
            'periode'=> $input['bulan'],
            'tahun'=> $input['tahun'],
            'last_period'=> $end,
            'date' => date('m/d/Y'),
            'laporan' => $laporan
        ];

        $pdf = PDF::loadView('savePDF',$data);

        $nama_file = date('YmdHis')."-".$input['bulan']."-".$input['tahun'].".pdf";

        // $content = $pdf->download()->getOriginalContent();
        Storage::put('public/pdf/laporan/'.$nama_file, $pdf->output());

        $input['data'] = $nama_file;
        $log = laporan::create($input);



        return redirect('/admin/laporan')->with('success','berhasil create laporan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $end = new Carbon('last day of this month');
        $end = Carbon::parse($end)->format('Y-m-d');
        $all_barang = barang::all();
        $all_kategori = katbarang::all();
        $all_pembukuan = pembukuan::all();

        $count_barang = $all_barang->count();
        $count_kategori = $all_kategori->count();
        $count_pembukuan = $all_pembukuan->count();

        $laporan = DB::table('katbarangs')
        ->join('barangs','katbarangs.id','=','barangs.id_kategori')
        ->join('pembukuans','barangs.id','=','pembukuans.id_barang')
        ->where('pembukuans.bulan',date('m'))
        ->get();

        $data = [
            'title' => 'Laporan Bulanan',
            'toko'=> 'Sofi Grosir',
            'periode' => date('m'),
            'tahun' => date('Y'),
            'last_period'=> $end,
            'date' => date('m/d/Y'),
            'laporan' => $laporan
        ];


        // dd($laporan);
        return view('myPDF',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tampilan($id)
    {
        $tampil = laporan::find($id);
        $file = $tampil['data'];
        // dd($file);
        return response()->file('storage/pdf/laporan/'.$file);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = laporan::find($id);
        $old_data = 'storage/pdf/laporan/'.$delete->data;
        $delete->delete();
        // dd($old_data);
        if(file_exists($old_data)){
            unlink($old_data);
        }

        return redirect('admin/laporan')->with('success','Berhasil Delete Laporan');
    }
}
