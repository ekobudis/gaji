<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_id');
            $table->date('calculate_start');
            $table->date('calculate_end');
            $table->integer('calculate_period')->default(0);
            $table->integer('calculate_attend')->default(0);
            $table->decimal('calculate_overtime',12,2)->default(0);
            $table->decimal('calculate_gapok',12,2)->default(0);
            $table->decimal('calculate_allowance',12,2)->default(0);
            $table->decimal('calculate_overtime_amount',12,2)->default(0);
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
        Schema::dropIfExists('calculates');
    }
}
