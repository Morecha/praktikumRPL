<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barangs')->insert([
            'id_kategori'=>'1',
            'nama'=>'Tupperware',
            'total_stok'=>'0',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
