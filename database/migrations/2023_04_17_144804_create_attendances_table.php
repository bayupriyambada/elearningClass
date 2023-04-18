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
        Schema::create('attendances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('date_attendance');
            $table->boolean('isAbsensi')->default(0);
            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');
            $table->uuid('classes_id');
            $table->foreign('classes_id')
                ->references('id')
                ->on('classes')
                ->constrained()
                ->onDelete('cascade');
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
        Schema::dropIfExists('attendances');
    }
};
