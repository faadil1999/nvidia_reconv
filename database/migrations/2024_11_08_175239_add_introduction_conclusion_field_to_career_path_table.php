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
        Schema::table('career_paths', function (Blueprint $table) {
            $table->text('introduction')->nullable()->after('career_id');
            $table->text('conclusion')->nullable()->after('career_id');
            $table->text('comment')->nullable()->after('career_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career_paths', function (Blueprint $table) {
            $table->dropColumn(['introduction', 'conclusion', 'comment']);
        });
    }
};
