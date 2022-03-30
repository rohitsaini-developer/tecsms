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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number');
            $table->unsignedBigInteger('phone_country_id');
            $table->dateTime('phone_number_verified_at')->nullable();
            $table->string('user_token');
            $table->tinyInteger('register_status')->default(0)->comment('0=> register from register form, 1 => register from facebook, 2 => register from google, 3 => register from apple');
            $table->string('social_login_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
