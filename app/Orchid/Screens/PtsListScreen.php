<?php

namespace App\Orchid\Screens;
use App\Orchid\Layouts\StatusLayout;
use App\Models\PTS;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

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
            'pts'=>PTS::paginate()
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
                ->route('pts.edit')
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
            StatusLayout::class
        ];
    }
}
