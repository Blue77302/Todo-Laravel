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
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('first_name_verified_at')->nullable()->after('first_name');
            $table->timestamp('last_name_verified_at')->nullable()->after('last_name');
            $table->timestamp('address_verified_at')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name_verified_at');
            $table->dropColumn('last_name_verified_at');
            $table->dropColumn('address_verified_at');
        });
    }
};
