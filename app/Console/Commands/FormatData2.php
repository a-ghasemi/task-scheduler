<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class FormatData2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:matrix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows tasks as a matrix';

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
        $tasks = Task::all();

        $matrix = [];
        foreach($tasks as $task){
            $matrix[$task->level][] = $task->duration;
        }

        $this->print_matrix($matrix);
    }

    private function print_matrix($matrix){
        ksort($matrix);
        foreach($matrix as $key => $row){
            echo $key .' => ';
            echo implode('|',$row);
            echo "\n";
        }
    }
}
