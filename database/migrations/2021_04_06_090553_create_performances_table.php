<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id');
            $table->decimal('price');
            $table->integer('number');
            $table->decimal('commission_rate',2);
            $table->decimal('pending',2)->nullable();
            $table->decimal('start',2)->nullable();
            $table->string('remark')->nullable();
            $table->tinyInteger('status')->comment('1: 未开班, 2: 已开班');
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
        Schema::dropIfExists('performances');
    }
}
