<?php

namespace App\Orchid\Layouts;
use App\Models\PTS;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StatusLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'pts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'id')
                ->render(function (PTS $pts) {
                    return Link::make($pts->id)
                        ->route('pts.edit', $pts);
                }),

            TD::make('serial_pts', 'Серийный номер')
                ->sort()
                ->render(function (PTS $pts) {
                    return Link::make($pts->serial_pts)
                        ->route('pts.edit', $pts);
                }),
            TD::make('city', 'Город')
                ->render(function (PTS $pts) {
                    return Link::make($pts->city)
                        ->route('pts.edit', $pts);
                }),
            TD::make('address', 'Адресс')
                ->render(function (PTS $pts) {
                    return Link::make($pts->address)
                        ->route('pts.edit', $pts);
                }),
            TD::make('ip', 'IP')
                ->render(function (PTS $pts) {
                    return Link::make($pts->ip)
                        ->route('pts.edit', $pts);
                }),
            TD::make('ip', 'Дополнительная информация')
                ->render(function (PTS $pts) {
                    return Link::make($pts->info)
                        ->route('pts.edit', $pts);
                }),
            TD::make('created_at', 'Создано'),
            TD::make('updated_at', 'Обновлено'),
        ];
    }
}
