<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class view_demo_temp_hum extends Model
{
    use HasFactory;
    protected $table = 'view_demo_temp_hum';

    protected $fillable = [
                           'times',
                           'temperature',
                           'humidity',
                           'sensor_id',
                           'description',
                           'alarm_max_t',
                           'max_t',
                           'alarm_min_t',
                           'min_t',
                           'alarm_max_h',
                           'max_h',
                           'alarm_min_h',
                           'min_h',
                          ];

    public $timestamps = false; 
}
