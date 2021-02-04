<?php

namespace App\Console\Commands;

use App\Models\Developer;
use App\Models\Task;
use App\Models\TaskProvider;
use App\Support\TaskSaver;
use App\Support\Providers\FirstAdaptor;
use App\Support\Providers\SecondAdaptor;
use Illuminate\Console\Command;

class TasksDivide extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:divide';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Divides tasks between developers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasks = Task::where('scheduled',false)->get();
//        $developers = Developer::all();

        $times = [];
        foreach($tasks as $task){
            for($i=0; $i < $task->duration; $i++){
                $times[$task->level][] = [$task->id, $task->level];
            }
        }

        $this->print_matrix($times);

        return 0;
    }

    private function print_matrix($matrix){
        ksort($matrix);
        foreach($matrix as $key => $items){
            echo $key .' => ';
            $row = [];
            foreach($items as $item){
                $row[] = implode(',',$item);
            }
            echo implode('|',$row);

            echo "\n";
        }
    }

}
