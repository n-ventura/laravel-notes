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
        //php artisan make:migration create_users_table
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('username', 50)->nullable();
            $table->string('password', 200)->nullable();
            $table->datetime('last_login')->nullable();
            $table->timestamps(); // adiciona de forma automática o create_at e update_at
            $table->softDeletes();// Adiciona o deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
