<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'developer_id',
        'task_id',
        'week_number',
        'start',
        'duration',
    ];

}
