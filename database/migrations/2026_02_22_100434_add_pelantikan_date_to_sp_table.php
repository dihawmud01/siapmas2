<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sp', function (Blueprint $table) {
            $table
                ->date('pelantikan_date')
                ->nullable()
                ->after('expired_at');
        });
    }

    public function down(): void
    {
        Schema::table('sp', function (Blueprint $table) {
            $table->dropColumn('pelantikan_date');
        });
    }
};
