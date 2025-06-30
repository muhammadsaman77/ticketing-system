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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('handler_id')->nullable()->constrained('handlers')->onDelete('set null');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', [
                'OPEN',
                'IN_PROGRESS',
                'PENDING_USER_ACTION',
                'RESOLVED',
                'CLOSED',
                'CANCELLED',
            ])->default('OPEN');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
