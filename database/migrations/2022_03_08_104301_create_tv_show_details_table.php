<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_show_details', function (Blueprint $table) {
            $table->id();

            $table->uuid('api_uuid');

            $table->text('title');

            $table->text('description')->nullable();

            $table->text('genre')->nullable();

            $table->string('cover_url', 4096)->nullable();

            $table->text('slug');

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
        Schema::dropIfExists('tv_show_details');
    }
};
