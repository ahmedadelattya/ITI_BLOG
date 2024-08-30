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
        Schema::table('posts', function (Blueprint $table) {
            // Drop the existing 'posted_by' column
            $table->dropColumn('user_id');

            // Add the 'posted_by' column back as a foreign key
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop the foreign key and column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Add the 'posted_by' column back as a string
            $table->string('user_id');
        });
    }
};
