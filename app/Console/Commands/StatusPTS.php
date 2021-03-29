<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
        $ip = DB::table('pts_status')->pluck('ip','serial_pts');

            foreach ($ip as $host) {
                exec("ping -c 4 " . $host, $output, $result);
                print_r($output);
                if ($result == 0) {
                    DB::table('pts_ip')->insert(['status' =>true, 'serial_pts' => '$ip']);
                } else
                    {
                    echo 'не работает';
                    DB::table('pts_ip')->insert(['status' =>false, 'serial_pts' => '$ip']);

                }
         }
        }

}
