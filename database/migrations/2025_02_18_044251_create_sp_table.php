<?php

use App\Enums\SubmissionStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const DAKWAH_DEPARTMENT_COORDINATOR = 'dakwah_department_coordinator';

    public function up(): void
    {
        Schema::create('sp', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type',100);
            $table->year('start_period');
            $table->year('end_period');
            $table->string('letter_number', 100)->nullable();
            $table->date('event_date');
            $table->string('event_location', 255);
            $table->string('mwc_letter_number', 100);
            $table->json('protectors');
            $table->json('advisors');
            $table->string('chairman', 100);
            $table->json('vice_chairmen');
            $table->string('secretary', 100);
            $table->json('vice_secretaries');
            $table->string('treasurer', 100);
            $table->json('vice_treasurers');
            $table->string('organization_department_coordinator', 100);
            $table->json('organization_department_members');
            $table->string('cadre_department_coordinator', 100);
            $table->json('cadre_department_members');
            $table->string('dakwah_department_coordinator', 100);
            $table->json('dakwah_department_members');
            $table->string('culture_department_coordinator', 100);
            $table->json('culture_department_members');
            $table->string('economy_institution_director', 100);
            $table->json('economy_institution_members');
            $table->string('press_institution_director', 100);
            $table->json('press_institution_members');
            $table->string('brigade_institution_director', 100);
            $table->json('brigade_institution_members');
            $table->enum('status', SubmissionStatus::getAll())->default(SubmissionStatus::PENDING);
            $table->dateTime('generated_at')->nullable();
            $table->dateTime('expired_at')->nullable();

            $table
                ->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sp');
    }
};