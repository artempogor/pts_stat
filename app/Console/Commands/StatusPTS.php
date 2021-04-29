<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\PTS;
use function GuzzleHttp\Promise\all;

class StatusPTS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pts:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверяет статус ПТС';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ptses = PTS::all();
        foreach ($ptses as $pts)
        {
            exec("ping -c 4 " .$pts->ip, $output, $result);
            if($result == 0)
                $pts->statuses()->create(['serial_pts'=>$pts->serial_pts,'ip'=>$pts->ip,'status'=>'работает','checked_up'=>Carbon::now()]);
            else
                $pts->statuses()->create(['serial_pts'=>$pts->serial_pts,'ip'=>$pts->ip,'status'=>'не работает','checked_up'=>Carbon::now()]);

            print_r($pts->serial_pts);
        }

        }

}
