<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            [
                'id_area'=>'ARE001',
                'nama_area'=> 'Office',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'id_area'=>'ARE002',
                'nama_area'=> 'Lantai Basement RS',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
