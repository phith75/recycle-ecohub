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
        // In create_time_trash_table migration
        Schema::create('time_trash', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->integer('id_trash')->nullable();
            $table->timestamps();
            $table->softDeletes(); // delete

        });

        // Similarly for other tables (trash, type_trash, users)

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_trash');
    }
};
