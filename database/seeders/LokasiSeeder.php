<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lokasis')->insert([
            [
                'id_lokasi'=>'LOC001',
                'nama_lokasi'=> 'R. latih',
            ],
            [
                'id_lokasi'=>'LOC002',
                'nama_lokasi'=> 'Parkir Ambulan',
            ],
        ]);
    }
}
