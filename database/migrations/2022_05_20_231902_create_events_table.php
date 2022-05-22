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
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('all_day', ['true', 'false'])->default('true');
            $table->text('title')->nullable();
            $table->text('url')->nullable();
            $table->string('type')->default('public_holiday')->comment('vacation or public holiday or session or any other event');
            $table->unsignedBigInteger('request_by');
            $table->foreign('request_by')->references('id')->on('users');
            $table->dateTime('request_at');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
            $table->dateTime('approved_at')->nullable();
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
        Schema::dropIfExists('events');
    }
}
