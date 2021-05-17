<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Status;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Color;

class StatusPTSLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'pts_status';

    protected function striped(): bool
    {
        return true;
    }
    public function status(): ?Color
    {
        return Color::INFO();
    }
    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('pts_id', 'id')
                ->render(function (Status $pts_status) {
                    return Link::make($pts_status->pts_id);
                }),
            TD::make('serial_pts', 'Cерийный номер')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Status $pts_status) {
                    return Link::make($pts_status->serial_pts)
                        ->route('pts.more',$pts_status->serial_pts);

                }),
            TD::make('ip', 'IP')
                ->filter(TD::FILTER_TEXT)
                ->sort()
                ->render(function (Status $pts_status) {
                    return Link::make( $pts_status->ip);
                }),

            TD::make('status', 'Статус')
                ->sort()
                ->render(function (Status $pts_status)
                {
                    return Link::make( $pts_status->status);
                }),

            TD::make('checked_up', 'Время провeрки')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Status $pts_status) {
                    return Link::make( $pts_status->checked_up);
                }),

        ];

    }
    public function query(): array
    {
        return [
            'pts_id' => '$93 960',
        ];
    }
}
