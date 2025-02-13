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
        Schema::create('member_guardian_detail', function (Blueprint $table) {
            $table->bigIncrements('mgd_id')->primary();
            $table->int('member_id');
            $table->string('father_name');
            $table->string('father_dob');
            $table->string('father_current_address');
            $table->string('father_occupation');
            $table->string('mother_name');
            $table->string('mother_dob');
            $table->string('mother_current_address');
            $table->string('mother_occupation');
            $table->string('guardian_phone');
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
