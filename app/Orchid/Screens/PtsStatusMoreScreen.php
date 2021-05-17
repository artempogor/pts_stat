<?php

namespace App\Orchid\Screens;

use App\Models\Status;
use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use App\Orchid\Layouts\PtsStatusmoreLayout;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\PtsStatusMoreEditLayout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Toast;

class PtsStatusMoreScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Подробнее о ПТС';

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
    public function query(Status $pts_status ): array
    {
        return [
            'pts_status' => (Status::where('pts_id',$pts_status->pts_id))
                ->filters()
                ->paginate(10)
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
            Link::make('Вернутся к остальным')
                ->icon('action-undo')
                ->route('pts.status'),

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
            PtsStatusmoreLayout::class,
            Layout::modal('oneAsyncModal', PtsStatusMoreEditLayout::class)
                ->async('saveStateAndFio'),
        ];


    }
    public function asyncStateAndFio(Status $pts_status): array
    {
        return [
            'pts_status' => $pts_status,
        ];
    }

    /**
     * @param User    $user
     * @param Request $request
     */
    public function saveStateAndFio(Status $pts_status, Request $request)
    {

        $pts_status->fill($request->input('pts_status'))
//            dd($pts_status);
            ->save();

        Toast::info(__('ФИО и состояние были сохранены!'));
    }
}
