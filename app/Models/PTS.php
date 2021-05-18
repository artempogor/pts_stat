<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use App\Models\Status;
use Orchid\Metrics\Chartable;
use Carbon\Carbon;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filter;
class PTS extends Model
{
    use Filterable;
    use Chartable;
    use AsSource;
    use Attachable;


    protected $table = 'pts';
        protected $allowedFilters = [
            'serial_pts',

        ];
        protected $allowedSorts =
            [
                'ip',
                'serial_pts',
                'city',
                'address',
                'status',
                'info',
            ];
        protected $fillable = [
            'ip',
            'serial_pts',
            'city',
            'address',
            'status',
            'info',
            'place',
        ];
    protected $casts = [
        'place' => 'array',
    ];
//        public function presenter()
//        {
//            return new IdeaPresenter($this);
//        }
        public function statuses()
        {
            return $this->hasMany(Status::class,'pts_id');
        }

}
