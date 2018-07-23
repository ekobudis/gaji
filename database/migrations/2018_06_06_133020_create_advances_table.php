<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->date('advance_date');
            $table->date('advance_refund');
            $table->string('advance_desc',120)->nullable();
            $table->decimal('advance_amount',12,2)->default(0);
            $table->decimal('advance_balance',12,2)->default(0);
            $table->integer('advance_paid')->default(0);
            $table->integer('advance_status')->default(0);
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
        Schema::dropIfExists('advances');
    }
}
