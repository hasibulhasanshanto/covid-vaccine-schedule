<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vaccination_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaccine_center_id')
            ->constrained('vaccine_centers')
            ->cascadeOnDelete();
            $table->date('date');
            $table->integer('available_slots');
            $table->integer('total_slots'); // Same as center capacity on the given date

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccination_schedules');
    }
};
