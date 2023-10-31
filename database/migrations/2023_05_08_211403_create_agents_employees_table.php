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
        Schema::create('agents_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agents_store_id');
            $table->enum('role', ['Karyawan Toko', 'Karyawan Gudang']);
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
        Schema::dropIfExists('agents_employees');
    }
};
