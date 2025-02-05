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
        Schema::create('member_registration_detail', function (Blueprint $table) {
            $table->bigIncrements('mrd_id')->primary();
            $table->int('member_id');
            $table->date('registration_date');
            $table->date('expiration_date', 50);
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
