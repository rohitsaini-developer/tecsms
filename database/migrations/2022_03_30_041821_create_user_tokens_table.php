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
        Schema::create('user_tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('user_email_token', 32);
            $table->string('user_phone_token', 32);
            $table->boolean('email_token_status')->default(0)->comment("0=> not active, 1=> expire 2 => active");
            $table->boolean('phone_token_status')->default(0)->comment("0=> not active, 1=> expire 2 => active");
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
        Schema::dropIfExists('user_tokens');
    }
};
