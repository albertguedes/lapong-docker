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
        Schema::create('medical_case_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('medical_case_id');
            $table->foreignId('medical_case_record_type_id');

            $table->string('title');
            $table->string('description');
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_case_records');
    }
};
