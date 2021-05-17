<?php

namespace App\Orchid\Layouts;

use App\Orchid\Filters\PtsFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class FiltersPTS extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return [
            PtsFilter::class,
        ];
    }
}
