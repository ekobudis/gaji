<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_code',20);
            $table->string('project_name',180)->nullable();
            $table->string('project_desc',255)->nullable();
            $table->date('project_start');
            $table->date('project_end');
            $table->decimal('project_amounts',18,2)->default(0);
            $table->integer('employee_id'); //Project PIC
            $table->integer('project_status')->default(0);
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
        Schema::dropIfExists('projects');
    }
}
