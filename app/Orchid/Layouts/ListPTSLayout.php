<?php

namespace App\Orchid\Layouts;
use App\Models\PTS;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Illuminate\Support\Str;

class ListPTSLayout extends Table
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
    protected function striped(): bool
    {
        return true;
    }
    protected function onEachSide(): int
    {
        return 3;
    }
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

            TD::make('serial_pts', __('Серийный номер'))
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make('city', 'Город'),
            TD::make('address', 'Адресс'),
            TD::make('ip', 'IP'),
            TD::make('info', 'Дополнительная информация')
                ->render(function (PTS $pts) {
                    return Str::limit(($pts->info),100);
                })
                ->width('100px'),
            TD::make('updated_at', __('Созданно'))
                ->sort()
                ->render(function (PTS $pts) {
                    return $pts->created_at->toDateTimeString();
                }),
            TD::make('updated_at', __('Обновлено'))
                ->sort()
                ->render(function (PTS $pts) {
                    return $pts->updated_at->toDateTimeString();
                }),
        ];
    }
}
