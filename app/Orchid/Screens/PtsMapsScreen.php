<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\AllPtsMaps;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PtsMapsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Карта ПТС';

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
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::view('allmaps'),
        ];
    }

}
