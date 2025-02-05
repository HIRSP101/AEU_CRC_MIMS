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
        Schema::create('member_middle_management', function (Blueprint $table) {
            $table->bigIncrements('mim_id')->primary();
            $table->string('name', 50);
            $table->string('position', 50);
            $table->int('branch_id');
            $table->int('member_id');
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
