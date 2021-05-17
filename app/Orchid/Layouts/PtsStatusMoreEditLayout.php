<?php
declare(strict_types=1);

namespace App\Orchid\Layouts;

use App\Models\Workers;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class PtsStatusMoreEditLayout extends Rows
{

    public function fields(): array
    {
        return [
            Select::make('pts_status.fio_workers')
                ->required()
                ->title(__('ФИО'))
                ->fromModel(Workers::class, 'fio','fio'),
            Select::make('pts_status.state')
                ->required()
                ->title(__('Состояние'))
                ->options(
                    [
                        'A'=>'Действие А',
                        'B'=>'Действие B',
                        'Отремонтированно'=>'Отремонтированно',
                    ]
                )

        ];
    }
}
