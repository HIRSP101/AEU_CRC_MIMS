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
        Schema::create('branch_leadership', function (Blueprint $table) {
            $table->bigIncrements('leadership_id')->primary();
            $table->string('name', 50);
            $table->string('gender', 10);
            $table->string('phone_number', 45);
            $table->string('position', 45);
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
