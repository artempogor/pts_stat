<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Workers extends Model
{
    use Filterable;
    use Chartable;
    use AsSource;

    protected  $table = 'workers';

    protected $allowedFilters = [
        'tn',

    ];
    protected $allowedSorts =
        [
            'fio',
            'post',
            'phone',
            'tn'
        ]
    ;
    protected $fillable = [
        'fio',
        'post',
        'phone',
        'tn'
    ];
}
