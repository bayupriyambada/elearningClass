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
        Schema::create('task_sub_lessons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('url_submit')->nullable();
            $table->uuid('sub_lesson_id');
            $table->foreign('sub_lesson_id')
                ->references('id')
                ->on('sub_lessons')
                ->constrained()
                ->onDelete('cascade');
            $table->uuid('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->constrained()
                ->onDelete('cascade');
            $table->string('information')->nullable();
            $table->string('grade')->nullable();
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
        Schema::dropIfExists('task_sub_lessons');
    }
};
