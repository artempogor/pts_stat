<?php

namespace App\Orchid\Screens;
use App\Exports\PtsExport;
use App\Orchid\Layouts\FiltersPTS;
use App\Orchid\Layouts\ListPTSLayout;
use App\Models\PTS;
use Maatwebsite\Excel\Facades\Excel;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use PHPUnit\Util\Filter;

class PtsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'ПТС';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Все Терминалы';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'pts'=>PTS::filters()
            ->defaultSort('id')
            ->paginate(6),
//            'sort_pts'=>PTS::with('serial_pts')
//                ->filters()
//                ->filtersApplySelection(FiltersPTS::class)
//                ->defaultSort('id', 'desc')
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
            Link::make('Создать запись')
                ->icon('pencil')
                ->route('pts.edit'),
            Button::make(__('Экспорт в Exel'))
                ->type(Color::DEFAULT())
                ->icon('printer')
                ->method('export'),

        ];
    }
    public function export()
    {
         Excel::download(new PtsExport, 'pts.xlsx');
        Toast::info(__('Profile updated.'));
    }
    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     * .
     */
    public function layout(): array
    {
        return [
            ListPTSLayout::class,
        ];
    }
}
