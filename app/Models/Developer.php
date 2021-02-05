<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    public function tasks(){
        return $this->hasManyThrough(Task::class,DeveloperTask::class);
    }

    public function taskTimes(){
        return $this->hasMany(DeveloperTask::class);
    }

    public function getLastTime(){
        $this->taskTimes()->orderByDesc('id')->first();
    }

    public function getLastPosition(){
        $pos = $this->taskTimes()->orderByDesc('id')->first();
        return [
            'week' => $pos->week_number ?? 1,
            'start' => ($pos->start ?? 0) + ($pos->duration ?? 0)
        ];

//        $week = $pos->week_number ?? 1;
//        $hour = ($pos->start ?? 0) + ($pos->duration ?? 0);
//        while($hour > $this->per_week){
//            $week++;
//            $hour -= $this->per_week;
//        }
//        return [$week, $hour];
    }

    public function assignTask($id, $level, $week, $start, $duration){
        DeveloperTask::create([
            'developer_id' => $this->id,
            'task_id' => $id,
            'week_number' => $week,
            'start' => $start,
            'duration' => $duration,
            'level' => $level,
        ]);
    }

}
