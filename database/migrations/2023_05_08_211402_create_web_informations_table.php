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
        Schema::create('web_information', function (Blueprint $table) {
            $table->id();
            $table->string('favicon', 255);
            $table->string('logo_main', 255);
            $table->string('logo_secondary', 255);
            $table->string('title', 60);
            $table->string('description', 180);
            $table->string('long_description', 255);
            $table->string('keywords', 255);
            $table->string('author', 50);
            $table->string('email', 50);
            $table->string('phone', 25);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_information');
    }
};
