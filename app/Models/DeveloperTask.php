<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperTask extends Model
{
    use HasFactory;

    public $timestamps = null;

    protected $fillable = [
        'developer_id',
        'task_id',
        'week_number',
        'start',
        'duration',
        'level',
    ];

    public function developer(){
        return $this->belongsTo(Developer::class);
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public static function getSummary(){
        $last_week = Self::max('week_number');
        $time_sumation = Self::groupBy('developer_id')
            ->selectRaw('sum(`duration`) as duration')
            ->get()
            ->max('duration');

        return [
            'week' => $last_week,
            'hours' => $time_sumation,
        ];
    }
}
