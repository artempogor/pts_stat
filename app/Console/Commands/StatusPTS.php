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
        $add = new PTS;
        foreach ($add as $adds)
        {
            $f = 'q';
            $add->info = 1;
            $add->save();
        }
//        $host="128.2.0.112";
//        exec("ping -c 4 " . $host, $output, $result);
//        print_r($output);
//        if ($result == 0) {
//            $add = new PTS;
//            $add->status = 1;
//            $add->save();
//        }
//        else {
//            $add = new PTS;
//            $add->status = 0;
//            $add->save();
//        }
//        echo 'данные занесены!';
    }
}
