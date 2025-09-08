<?php

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
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->enum('status', ['new', 'in_progress', 'resolved', 'closed'])->default('new');
        $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        $table->foreignId('agent_id')->nullable()->constrained('users')->onDelete('set null'); 
        $table->foreignId('category_id')->nullable()->constrained('ticket_categories')->onDelete('set null');
        $table->timestamp('resolved_at')->nullable();
        $table->timestamp('closed_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
