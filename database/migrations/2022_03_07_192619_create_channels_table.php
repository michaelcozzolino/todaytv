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
        Schema::create('channels', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50);

            $table->unsignedBigInteger('tv_group_id')->nullable();

            $table
                ->foreign('tv_group_id')
                ->references('id')
                ->on('tv_groups')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->integer('number');

            $table->string('api_id');

            $table->string('slug');

            $table->unique(['id', 'api_id']);
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
        Schema::dropIfExists('channels');
    }
};
