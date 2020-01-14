<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->string('start');
            $table->string('end');
            $table->string('backgroundColor')->nullable();
            $table->integer('status')->default(0);
            $table->bigInteger('calendar_id')->unsigned();
            $table->timestamps();



        });

        Schema::table('events', function($table) {
            $table->foreign('calendar_id')
                ->references('id')->on('calendars')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
