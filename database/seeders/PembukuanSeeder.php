<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembukuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pembukuans')->insert([
            'id_barang'=>'1',
            'id_staff'=>'1',
            'status'=>'masuk',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
