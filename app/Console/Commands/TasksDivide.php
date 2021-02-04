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
        $tasks = Task::where('scheduled', false)->get();
//        $developers = Developer::all();

        $times = [];
        foreach ($tasks as $task) {
            for ($i = 0; $i < $task->duration; $i++) {
                $times[$task->level][] = [$task->id, $task->level];
            }
        }

        $times = $this->Sanitize($times);

        $this->print_matrix($times);
        $this->comment('--------------');

        $times = $this->Mix($times);

        $this->print_matrix_2($times);

        return 0;
    }

    private function print_matrix($matrix)
    {
        ksort($matrix);
        foreach ($matrix as $key => $items) {
            echo $key . ' => ';
            $row = [];
            foreach ($items as $item) {
                $row[] = implode(',', $item);
            }
            echo implode('|', $row);

            echo "\n";
        }
    }

    private function print_matrix_2($matrix)
    {
        foreach ($matrix as $key => $items) {
            echo $key . ' => ';
            $row = [];
            foreach ($items as $id => $item) {
                foreach ($item as $level => $count) {
                    $row[] = implode(',', [$id,$level,$count]);
                }
            }
            echo implode('|', $row);

            echo "\n";
        }
    }

    protected function Sanitize(array $times): array
    {
        $count = 0;
        do {
            $count++;
            $repeat = false;
            for ($i = 4; $i > 0; $i--) {
                for ($j = $i + 1; $j <= 5; $j++) {
                    if (count($times[$i]) - count($times[$j]) >= 2) {
                        $times[$j][] = array_pop($times[$i]);
                        $repeat = true;
                    }
                }
            }
        } while ($repeat);

        $this->comment($count);

        return $times;
    }

    protected function Mix(array $times): array
    {
        $new_times = [];
        for ($i = 1; $i <= 5; $i++) {
            foreach($times[$i] as $time){//$time = id,level
                $new_times[$i][$time[0]][$time[1]] = $new_times[$i][$time[0]][$time[1]] ?? 0;
                $new_times[$i][$time[0]][$time[1]]++;
            }
        }

        return $new_times;
    }

}
