<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Carbon\Carbon;
use Orchid\Filters\Filter;
use Laravel\Scout\Searchable;

class Status extends Model
{
    use Searchable;
    use Filterable;
    use AsSource;


    protected $primaryKey = 'id';
    protected $allowedFilters =
        [
         'id',
         'pts_id',
         'serial_pts',
         'status',
         'ip',
         'checked_up',
         'fio_workers',
         'state',
        ];

    protected $table = 'pts_status';
    protected $fillable = [
        'id',
        'status',
        'checked_up',
        'ip',
        'serial_pts',
        'checked_up',
        'fio_workers',
        'state'
        ];
//    protected $appends = [
//        'state','fio_workers'
//    ];
    public function pts()
    {
        return $this->belongsTo(PTS::class);
    }

}
