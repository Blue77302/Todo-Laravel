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
            $table->string('name')->default('')->nullable(false);
            $table->string('first_name', 30)->default('');
            $table->string('last_name', 20)->default('');
            $table->rememberToken();
            $table->string('email', 100);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('address', 200)->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default(0);
            $table->string('role')->default('user');
            $table->timestamps();
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
