<?php

namespace App\Orchid\Screens;

use App\Models\Workers;
use App\Orchid\Layouts\ListPTSLayout;
use App\Orchid\Layouts\WorkersListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class WorkersListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Cправочник работников';

    /**
     * Display header description.
     *
     * @var string|null
     */


    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'workers'=>Workers::filters()
                ->defaultSort('tn')
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
                ->route('workers.edit')
        ];
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
            WorkersListLayout::class
        ];
    }
}
