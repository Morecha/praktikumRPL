<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KatbarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('katbarangs')->insert([
            'kategori'=>'Alat Makan',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
