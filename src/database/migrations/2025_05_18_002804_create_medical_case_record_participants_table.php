<?php declare(strict_types=1);

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
        Schema::create('medical_case_record_participants', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();

            $table->foreignId('medical_case_record_id');
            $table->foreignId('participant_id')->constrained('customers');

            $table->unique(['medical_case_record_id', 'participant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_case_record_participants');
    }
};
