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
        Schema::create('member_personal_detail', function (Blueprint $table) {
            $table->bigIncrements('member_id')->primary();
            $table->string('name_kh');
            $table->string('name_en');
            $table->string('gender');
            $table->string('nationality');
            $table->string('date_of_birth');
            $table->string('image', 100);
            $table->string('full_current_address');
            $table->string('phone_number');
            $table->string('email');
            $table->string('facebook');
            $table->string('national_id');
            $table->string('shirt_size', 45);
            $table->string('member_type', 45);
            $table->string('member_code', 45);
            $table->timestamp();
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
