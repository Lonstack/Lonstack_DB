<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->longText('challenge')->nullable()->after('description');
            $table->longText('solution')->nullable()->after('challenge');
            $table->json('technologies')->nullable()->after('solution');
            $table->json('features')->nullable()->after('technologies');
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['challenge', 'solution', 'technologies', 'features']);
        });
    }
};
