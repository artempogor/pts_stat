<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use App\Models\PTS;
class PtsFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['pts'];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('serial_pts');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('serial_pts', $this->request->get('pts'));


        }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Input::make('serial_pts')
                ->type('text')
                ->value($this->request->get('serial_pts'))
                ->placeholder('Search...')
                ->title('Search')
        ];
    }

}
