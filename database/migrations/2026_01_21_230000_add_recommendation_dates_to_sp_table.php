<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sp', function (Blueprint $table) {
            $table
                ->date('mwc_letter_date')
                ->nullable()
                ->after('mwc_letter_number');
            $table
                ->date('pac_letter_date')
                ->nullable()
                ->after('pac_letter_number');
        });
    }

    public function down(): void
    {
        Schema::table('sp', function (Blueprint $table) {
            $table->dropColumn(['mwc_letter_date', 'pac_letter_date']);
        });
    }
};
