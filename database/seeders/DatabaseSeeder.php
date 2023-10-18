<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([AreaSeeder::class]);
        $this->call([LokasiSeeder::class]);
        $this->call([AcSeeder::class]);
        DB::table('teknisis')->insert([
            [
                'id_teknisi'=>'TKN001',
                'nama_teknisi'=> 'Yogi',
                'type_teknisi'=> 'Internal',
            ],
            [
                'id_teknisi'=>'TKN002',
                'nama_teknisi'=> 'Doni',
                'type_teknisi'=> 'External',
            ],
        ]);
    }
}
