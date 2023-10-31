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
        Schema::create('distributors', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('Distributor');
            $table->string('name', 60);
            $table->string('username', 25)->unique();
            $table->string('email', 255)->unique();
            $table->text('password');
            $table->dateTime('last_signin_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at')->nullable();;
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
        Schema::dropIfExists('distributors');
    }
};
