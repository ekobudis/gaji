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
            $table->integer('user_id');
            $table->string('employee_code',10);
            $table->string('employee_address',180)->nullable();
            $table->date('employee_birthdate');
            $table->date('employee_join_date');
            $table->integer('department_id');
            $table->integer('position_id');
            $table->decimal('employee_basic',12,2)->default(0);
            $table->decimal('employee_allowance',12,2)->default(0);
            $table->integer('employee_status')->default(0);
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
        Schema::dropIfExists('employeeloyees');
    }
}
