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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->foreignId('role_id')->constrained();
            $table->foreignId('wallet_id')->constrained();
            $table->string('telephone', 16);
            $table->string('avatar', 100)->default('img/avatars/avatar.jpg');
            $table->date('foundation_date');
            $table->date('signup_date');
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
