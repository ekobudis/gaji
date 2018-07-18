<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_id',10);
            $table->string('emp_name',80);
            $table->string('emp_address',180)->nullable();
            $table->date('emp_birthdate');
            $table->date('emp_join_date');
            $table->integer('dept_id');
            $table->integer('position_id');
            $table->decimal('emp_basic',12,2)->default(0);
            $table->decimal('emp_allowance',12,2)->default(0);
            $table->integer('emp_status')->default(0);
            $table->integer('user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
