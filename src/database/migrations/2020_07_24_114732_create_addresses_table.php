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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->morphs('addressable');
            $table->string('label')->nullable();
            $table->string('postal_code');
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('city');
            $table->string('region');
            $table->string('state_or_province');
            $table->string('country');
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
