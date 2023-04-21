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
        Schema::create('submits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('subject_submit');
            $table->string('assign_url');
            $table->boolean('isSubmit');
            $table->uuid('assignment_id');
            $table->foreign('assignment_id')
            ->references('id')
                ->on('assignments')
            ->constrained()
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->dateTime('sent_assignment');
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
        Schema::dropIfExists('submits');
    }
};
