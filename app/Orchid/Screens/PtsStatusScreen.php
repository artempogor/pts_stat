<?php

namespace App\Orchid\Screens;

use App\Models\Status;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ChartLineExample;
use App\Orchid\Layouts\Examples\ChartPieExample;
use App\Orchid\Layouts\Examples\MetricsExample;
use App\Orchid\Layouts\StatusPTSLayout;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Orchid\Screen\Screen;

use App\Orchid\Layouts\ChartsLayout;
use App\Models\PTS;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Link;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
class PtsStatusScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Cтатус всех ПТС';


    /**
     * Display header description.
     *
     * @var string|null
     */
   // public $description = 'PtsStatusScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public $exists = false;

    protected function textNotFound(): string
    {
        return __('Пока нет статуса');
    }
    public function query(Status $status): array
    {
        return [
            'pts_work_charts'=>
        [
            [
                'title' => 'работ ПТС',
                'values'=>[count(Status::where('status','работает')->where('checked_up','>=',Carbon::now()->subMinute(5))->get()),count(Status::where('status','не работает')->where('checked_up','>=',Carbon::now()->subMinute(5))->get())],
                'labels'=>['работает' ,'не работает']
            ],

        ],
            'pts_state_charts'=>
                [
                    [
                        'title' => 'Cостояние',
                        'values'=>[
                            count(Status::where('state','A')
                            ->where('checked_up','>=',Carbon::now()->subMinute(5))
                              ->get()),
                            count(Status::where('state','B')
                                ->where('checked_up','>=',Carbon::now()->subMinute(5))
                                ->get()),
                            count(Status::where('state','C')
                                ->where('checked_up','>=',Carbon::now()->subMinute(5))
                                ->get())
                        ],

                        'labels'=>['работает' ,'не работает']
                    ],

                ],
            'metrics' => [
                ['keyValue' => number_format(count(Status::where('state','A')
                    ->where('checked_up','>=',Carbon::now()->subDays(7))
                    ->get())), 'keyDiff' => 1],
                ['keyValue' => number_format(count(Status::where('state','B')
                    ->where('checked_up','>=',Carbon::now()->subDays(7))
                    ->get())), 'keyDiff' => -30.76],
                ['keyValue' => number_format(count(Status::where('state','C')
                    ->where('checked_up','>=',Carbon::now()->subDays(7))
                    ->get())), 'keyDiff' => 3.84],
                ['keyValue' => number_format(count(Status::where('state','Отремонтированно')
                    ->where('checked_up','>=',Carbon::now()->subDays(7))
                    ->get())), 'keyDiff' => 0],
            ],
            'pts_status' => Status::where('checked_up','>=',Carbon::now()->subMinute(5))->filters()->defaultSort('pts_id')->paginate(10)
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            ChartPieExample::class,
            StatusPTSLayout::class,
            MetricsExample::class
        ];
    }
}
