<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftUserTable extends Migration
{
    public function up()
    {
        Schema::create('gift_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gift_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gift_user');
    }
}
