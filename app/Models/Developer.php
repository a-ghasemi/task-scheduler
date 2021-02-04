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

}
