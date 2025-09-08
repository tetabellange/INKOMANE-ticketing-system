<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ticket_comments', function (Blueprint $table) {
            if (!Schema::hasColumn('ticket_comments', 'ticket_id')) {
                $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('ticket_comments', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('ticket_comments', 'comment')) {
                $table->text('comment');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ticket_comments', function (Blueprint $table) {
            $table->dropColumn(['ticket_id', 'user_id', 'comment']);
        });
    }
};

