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
            $table->string('phone')->nullable();
            $table->integer('available')->comment("0 => unavailable, 1 => available, 2 => available but saving another handover")->default(1);
            $table->integer('user_sub_id')->nullable();
            $table->integer('sub')->nullable();
            $table->softDeletes();

            // Index for email lookups (unique if your app enforces unique emails)
            $table->index('email', 'users_email_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('available');
            $table->dropColumn('user_sub_id');
            $table->dropColumn('sub');
        });
    }
};
