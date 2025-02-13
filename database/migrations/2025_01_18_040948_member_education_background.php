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
        Schema::create('member_education_background', function (Blueprint $table) {
            $table->bigIncrements('meb_id')->primary();
            $table->int('member_id');
            $table->int('institution_id');
            $table->int('branch_id');
            $table->int('branchhei_id');
            $table->string('academic_year');
            $table->string('major');
            $table->string('batch');
            $table->string('shift');
            $table->string('education_level');
            $table->string('language');
            $table->string('computer_skill');
            $table->string('misc_skill');
            $table->string('personal_skill');
            $table->string('institute_type');
            $table->string('training_received', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
