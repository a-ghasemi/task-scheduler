<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeveloperTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('developer_id');
            $table->foreignId('task_id');
            $table->unsignedSmallInteger('week_number');
            $table->unsignedSmallInteger('start');
            $table->unsignedSmallInteger('duration');
            $table->unsignedTinyInteger('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developer_tasks');
    }
}
