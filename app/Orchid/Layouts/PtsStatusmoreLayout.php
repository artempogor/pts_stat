<?php
declare(strict_types=1);

namespace App\Orchid\Layouts;

use App\Models\PTS;
use App\Models\Workers;
use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use App\Models\Status;

class PtsStatusmoreLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    public $permission = [
        'Read only'
    ];
    protected $target = 'pts_status';
    protected function striped(): bool
    {
        return true;
    }


    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [

            TD::make('serial_pts', 'Серийный номер')
                ->sort()
                ->render(function (Status $pts_status) {
                    return ($pts_status->serial_pts);

                }),
            TD::make('status', 'Статус')
                ->sort()
                ->render(function (Status $pts_status) {
                    return ($pts_status->status);

                }),
            TD::make('checked_up', 'Время проверки')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Status $pts_status) {
                    return ($pts_status->checked_up);
                }),
            TD::make('fio_workers', __('FIO'))
                ->sort()
                ->cantHide()
                ->render(function (Status $pts_status) {
                    return ModalToggle::make($pts_status->fio_workers)
                        ->modal('oneAsyncModal')
                        ->modalTitle('Время:'.$pts_status->checked_up.'     ПТС:'.$pts_status->serial_pts)
                        ->method('saveStateAndFio')
                        ->icon('pencil')
                        ->asyncParameters([
                            'pts_status' => $pts_status->id,
                        ]);
                }),
            TD::make('state', __('Действие'))
                ->sort()
                ->render(function (Status $pts_status) {
                    return ModalToggle::make($pts_status->state)
                        ->modal('oneAsyncModal')
                        ->modalTitle('Время:'.$pts_status->checked_up.'     ПТС:'.$pts_status->serial_pts)
                        ->method('saveStateAndFio')
                        ->icon('pencil')
                        ->asyncParameters([
                            'pts_status' => $pts_status->id,
                        ]);
                }),
        ];

    }

}
