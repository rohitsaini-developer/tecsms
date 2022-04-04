<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 191)->default(null)->nullable();
            $table->text('value')->default(null)->nullable();
            $table->string('type', 191)->default(null)->nullable();
            $table->string('display_name', 191)->default(null)->nullable();
            $table->text('details')->default(null)->nullable()->nullable();
            $table->string('tag', 191)->default(null)->nullable();
            $table->enum('group', ['site', 'company', 'keys'])->default('site')->nullable();
            $table->enum('status', ['publish', 'unpublish'])->default('publish')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->unsignedInteger('created_by')->default(null)->nullable();
            $table->timestamp('updated_at')->default(Null)->nullable();
            $table->unsignedInteger('updated_by')->default(null)->nullable();
            $table->softDeletes();
            $table->unsignedInteger('deleted_by')->default(null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
