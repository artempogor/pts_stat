<?php

namespace App\Orchid\Filters;

use App\Models\Workers;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;

class WorkerFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['workers'];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('fio');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('fio', $this->request->get('workers'));


    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Input::make('fio')
                ->type('text')
                ->value($this->request->get('fio'))
                ->placeholder('Search...')
                ->title('Search')
        ];
    }

}
