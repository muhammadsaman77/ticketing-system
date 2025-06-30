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
        Schema::create('log_ticket_processing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->foreignId('handler_id')->nullable()->constrained('users')->onDelete('set null');
            $statuses = ['OPEN', 'IN_PROGRESS', 'PENDING_USER_ACTION', 'RESOLVED', 'CLOSED', 'CANCELLED'];
            $table->enum('from_status', $statuses)->nullable();
            $table->enum('to_status', $statuses);
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_ticket_processing');
    }
};
