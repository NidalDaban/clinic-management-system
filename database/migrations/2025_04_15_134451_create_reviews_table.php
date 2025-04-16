<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('ratings');
            $table->text('comment');

            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('psychologist_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();

            $table->timestamps();

            $table->foreign('patient_id', 'fk_reviews_patient')
                ->references('id')->on('users')->onDelete('cascade');

            $table->foreign('psychologist_id', 'fk_reviews_psychologist')
                ->references('id')->on('users')->onDelete('cascade');

            $table->foreign('doctor_id', 'fk_reviews_doctor')
                ->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
