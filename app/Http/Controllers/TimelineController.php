<?php

namespace App\Http\Controllers;

use App\Models\DeveloperTask;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index(Request $request){
        $items = [
            'week_number',
            'start',
            'developer_id',
            'task_id',
            'duration',
        ];

        $sort = $request->sort ?? 'developer_id';
        $sort = (in_array($sort, $items))?$sort:'developer_id';

        array_unshift($items, $sort);
        $items = array_unique($items);

//        dd($items);

        $times = new DeveloperTask;
        foreach($items as $item){
            $times = $times->orderBy($item);
        }
        $times = $times->get();

        return view('timeline')->withTimes($times);
    }
}
