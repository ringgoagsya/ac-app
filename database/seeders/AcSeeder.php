<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acs')->insert([
            [
                'id_ac'=>'IU-OF-1',
                'id_lokasi'=>'LOC0001',
                'id_area'=>'AREA001',
                'alarm_service'=>45,
                'type_lokasi' => 'INDOOR',
                'status'=> 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_ac'=>'IU-OF-2',
                'id_lokasi'=>'LOC0002',
                'id_area'=>'AREA002',
                'alarm_service'=>45,
                'type_lokasi' => 'INDOOR',
                'status'=> '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
