<?php

use App\Enums\RegistrationStatusEnum;
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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete();
            $table->foreignId('vaccine_center_id')
            ->constrained('vaccine_centers')
            ->cascadeOnDelete();
            $table->string('status')->default(RegistrationStatusEnum::NOT_SCHEDULED);
            $table->timestamp('registered_at')->default(now());
            $table->date('scheduled_date')->nullable();
            $table->timestamp('notified_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
