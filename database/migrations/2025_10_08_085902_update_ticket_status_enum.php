<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This updates the 'status' column in the tickets table
     * to allow: open, in_progress, resolved, closed.
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE tickets 
            MODIFY status ENUM('open', 'in_progress', 'resolved', 'closed') 
            DEFAULT 'open'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * This restores the column to its previous form.
     * (You can adjust the previous options if you had different ones before.)
     */
    public function down()
    {
        DB::statement("
            ALTER TABLE tickets 
            MODIFY status ENUM('new', 'in_progress', 'resolved', 'closed') 
            DEFAULT 'new'
        ");
    }
};
