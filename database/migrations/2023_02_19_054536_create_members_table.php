<?php

use App\Enums\Gender;
use App\Enums\MembershipStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('gender', Gender::getAll());
            $table->string('place_of_birth', 255);
            $table->date('date_of_birth');
            $table->text('address');
            $table->boolean('is_makesta');
            $table->boolean('is_lakmud');
            $table->boolean('is_lakut');
            $table->year('makesta_year')->nullable();
            $table->year('lakmud_year')->nullable();
            $table->year('lakut_year')->nullable();
            $table->boolean('is_diklatama');
            $table->boolean('is_diklatnas');
            $table->boolean('is_diklatmad');
            $table->boolean('is_latinpel');
            $table->enum('membership_status', MembershipStatus::getAll())->default(MembershipStatus::PAC_MEMBER);
            $table->string('phone', 13);
            $table->string('photo')->default('default.png');
            $table
                ->foreignId('pac_id')
                ->constrained('pac')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
