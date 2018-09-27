<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('group_id');
			$table->text('details');
			$table->tinyInteger('priority')->default(1); // 0 => Low, 1 => Normal, 2 => High
			$table->boolean('completed')->default(false);
			$table->date('due_date')->default(Carbon::now());
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
