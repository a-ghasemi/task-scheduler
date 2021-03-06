<?php

namespace App\Console\Commands;

use App\Models\Developer;
use App\Models\DeveloperTask;
use App\Models\Task;
use Illuminate\Console\Command;

class TasksDivide extends Command
{
    /*
     * Show matrix and arrays in CLI mode
     */
    protected $debug_show = true;

    /**
     * The name and signature of the console command.
     *
     * @var string
     *
     * force mode, removes previous schedules and do everything again
     */
    protected $signature = 'tasks:divide {--f|force}';

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
        if($this->option('force')) {
            $this->comment('Divide runs in FORCE mode');

            if(!$this->confirm("Force mode will truncate previous assigned tasks.\n" .
                "Are you sure you want to continue ?"))
                return 0;

            DeveloperTask::truncate();
            Task::where('scheduled',true)->update(['scheduled' => false]);
        }

        $tasks = Task::where('scheduled', false)->get();

        if($tasks->isEmpty()) {
            $this->comment('There is no new task to schedule.');
            return 0;
        }

        $times = $this->makeBaseMatrix($tasks);

        $times = $this->Sanitize($times);

        $times = $this->Mix($times);

        if($this->debug_show) $this->show_matring($times);

        $this->assignToDevelopers($times);

        Task::whereIn('id',$tasks->pluck('id'))->update(['scheduled' => true]);

        return 0;
    }

    protected function makeBaseMatrix($tasks): array
    {
        $times = [];
        foreach ($tasks as $task) {
            for ($i = 0; $i < $task->duration; $i++) {
                $times[$task->level][] = [$task->id, $task->level];
            }
        }
        return $times;
    }

    private function show_matring($matrix)
    {
        foreach ($matrix as $key => $items) {
            $sum = 0;
            echo $key . ' => ';
            $row = [];
            foreach ($items as $id => $item) {
                foreach ($item as $level => $count) {
                    $sum += $count;
                    $row[] = implode(',', [$id, $level, $count]);
                }
            }
            echo implode('|', $row);

            echo " ($sum)";
            echo "\n";
        }
    }

    protected function Sanitize(array $times): array
    {
        $count = 0;
        do {
            $count++;
            $repeat = false;
            for ($i = 4; $i >= 1; $i--) {
                for ($j = $i + 1; $j <= 5; $j++) {
                    if (count($times[$i]) - count($times[$j]) >= 2) {
                        $times[$j][] = array_pop($times[$i]);
                        $repeat = true;
                    }
                }
            }
            if ($repeat) $this->SortByLevel($times);

            for ($i = 2; $i <= 5; $i++) {
                for ($j = 1; $j < $i; $j++) {
                    if (
                        count($times[$i]) - count($times[$j]) >= 2
                        &&
                        last($times[$i])[1] <= $j
                    ) {
                        $times[$j][] = array_pop($times[$i]);
                        $repeat = true;
                    }
                }
            }
            if ($repeat) $this->SortByLevel($times);

        } while ($repeat);


        return $times;
    }

    protected function Mix(array $times): array
    {
        $new_times = [];
        for ($i = 1; $i <= 5; $i++) {
            foreach ($times[$i] as $time) {//$time = id,level
                $new_times[$i][$time[0]][$time[1]] = $new_times[$i][$time[0]][$time[1]] ?? 0;
                $new_times[$i][$time[0]][$time[1]]++;
            }
        }

        return $new_times;
    }

    protected function SortByLevel(array &$times): void
    {
        foreach ($times as &$row) {
            $n = count($row);
            for ($i = 0; $i < $n; $i++) {
                for ($j = 0; $j < $n - $i - 1; $j++) {
                    if ($row[$j][1] < $row[$j + 1][1]) {
                        list($row[$j], $row[$j + 1]) = [$row[$j + 1], $row[$j]];
                    }
                }
            }
        }

    }

    protected function assignToDevelopers(array $times):void{
        $mat = [];
        foreach($times as $index => $tasks){
            $developer = Developer::find($index);
            $mat[$index] = [];
            foreach($tasks as $id => $details){
                foreach($details as $level => $duration){
                    $last_pos = $developer->getLastPosition();

                    list($week,$start) = array_values($last_pos);

                    while($duration > 0){
                        $part = ($start + $duration < $developer->per_week)?
                            $duration:
                            $developer->per_week - $start;

                        if($part == 0) break;

                        $mat[$index][] = implode(',',[$id."|". $level, $week, $start.'|'. $part]);
                        $developer->assignTask($id, $level, $week, $start, $part);

                        $start = 0;
                        $duration -= $part;
                        $week++;
                    }



                }
            }
        }
        if($this->debug_show) dump($mat);
    }
}
