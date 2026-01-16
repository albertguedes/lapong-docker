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
        Schema::create('telephones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->morphs('telephoned');
            $table->string('label')->nullable();
            $table->string('ddi');
            $table->string('ddd');
            $table->string('number');
            $table->boolean('is_active');
            $table->unique(['ddi', 'ddd', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telephones');
    }
};
