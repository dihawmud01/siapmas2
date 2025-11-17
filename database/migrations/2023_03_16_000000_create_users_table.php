<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->default('default.png');
            $table->string('bio');
            $table->string('username')->unique();
            $table->string('slug')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('check')->default(false);
            $table
                ->foreignId('role_id')
                ->default(4)
                ->constrained()
                ->onDelete('cascade');
            $table
                ->foreignId('pac_id')
                ->nullable()
                ->constrained('pac')
                ->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
