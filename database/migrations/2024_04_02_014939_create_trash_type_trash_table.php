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
        Schema::create('trash_type_trash', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trash_id');
            $table->unsignedBigInteger('type_trash_id');
            $table->integer('weightable')->default(0);
            $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trash_type_trash');
    }
};
