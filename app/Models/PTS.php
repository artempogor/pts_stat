<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class PTS extends Model
{
    use AsSource;
        protected $table = 'pts_status';
        protected $primaryKey = 'id';

        protected $fillable = [
            'serial_pts',
            'city',
            'address',
            'ip',
            'status',
            'latitude',
            'longitude',
            'info',
        ];
}
