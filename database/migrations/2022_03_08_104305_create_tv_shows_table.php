<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_shows', function (Blueprint $table) {
            $table->id();

            $table->dateTime('starting_at');

            $table->dateTime('ending_at');

            $table->unsignedInteger('duration')->default(0);

            $table->unsignedBigInteger('channel_id');

            $table->foreign('channel_id')->references('id')->on('channels')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('tv_show_detail_id');

            $table->foreign('tv_show_detail_id')->references('id')->on('tv_show_details')
                ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('tv_shows');
    }
};
