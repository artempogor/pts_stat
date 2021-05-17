<?php

namespace App\Orchid\Layouts;

use App\Models\Workers;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class WorkersListLayout extends Table
{
    protected $target = 'workers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('tn', ' Табельный номер')
                ->render(function (Workers $workers) {
                    return Link::make($workers->tn)
                        ->route('workers.edit', $workers);
                }),
            TD::make('fio', __('ФИО'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Workers $workers) {
                    return Link::make($workers->fio)
                        ->route('workers.edit', $workers);
                }),
            TD::make('post', __('Должность'))
                ->render(function (Workers $workers) {
                    return Link::make($workers->post)
                        ->route('workers.edit', $workers);
                }),
            TD::make('phone', 'Номер телефона')
                ->render(function (Workers $workers) {
                    return Link::make($workers->phone)
                        ->route('workers.edit', $workers);
                }),

            TD::make('updated_at', 'Обновлено')->defaultHidden(),
        ];
    }
}
