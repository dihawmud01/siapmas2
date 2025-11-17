<?php

use App\Enums\FileCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sp_submission_files', function (Blueprint $table) {
            $table->id();
            $table->enum('category', FileCategory::getAll());
            $table->string('attachment', 255);

            $table->uuid('sp_id');
            $table
                ->foreign('sp_id')
                ->references('id')
                ->on('sp')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sp_submission_files');
    }
};
