<?php declare(strict_types=1);

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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('messages');

            $table->foreignId('sender_id')
                  ->constrained('customers');

            $table->foreignId('receiver_id')
                  ->constrained('customers');

            $table->string('subject');
            $table->text('message');

            $table->boolean('is_read');
            $table->boolean('is_deleted');
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
