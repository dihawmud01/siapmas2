<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sp', function (Blueprint $table) {
            $table
                ->string('organization_level', 10)
                ->default('PAC')
                ->after('type');
            $table
                ->string('sub_organization_name', 255)
                ->nullable()
                ->after('organization_level');
        });
    }

    public function down(): void
    {
        Schema::table('sp', function (Blueprint $table) {
            $table->dropColumn(['organization_level', 'sub_organization_name']);
        });
    }
};
