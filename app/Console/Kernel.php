<?php

namespace App\Console;

use App\Models\ac;
use Carbon\Carbon;
use App\Models\area;
use App\Models\lokasi;
use App\Models\teknisi;
use App\Models\tr_service;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
            $schedule->call(function () {
                $now = Carbon::now()->format('Y-m-d');
                $ac = ac::all();
                foreach ($ac as $detail_ac) {
                    $last_service[$detail_ac->id_ac] = tr_service::where('id_ac','=',$detail_ac->id_ac)->orderBy('tanggal_service','desc')->first();
                    if($last_service[$detail_ac->id_ac]){
                        $selisih[$detail_ac->id_ac] = Carbon::parse($last_service[$detail_ac->id_ac]->tanggal_service)->diffInDays($now);
                        if($selisih[$detail_ac->id_ac] >= $detail_ac->alarm_service){
                            $service[$detail_ac->id_ac] ="true";
                            // dd( $selisih,$service);
                            if($service[$detail_ac->id_ac] ="true"){
                                \Log::info("Ringgo JALAN");
                                ac::where('id_ac','=', $detail_ac->id_ac)
                                ->update(['status' => 0]);
                            }
                        }
                        else{
                            $service[$detail_ac->id_ac] = "false";
                        }
                    }else{

                    }
                }
            })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
