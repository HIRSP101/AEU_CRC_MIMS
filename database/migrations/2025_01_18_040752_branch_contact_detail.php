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
        Schema::create('branch_contact_detail', function (Blueprint $table) {
            $table->bigIncrements('bcd_id')->primary();
            $table->int('branch_id');
            $table->string('branch_social_media');
            $table->string('branch_email');
            $table->string('branch_phone');
            $table->string('commune');
            $table->string('village');
            $table->string('sangkat');
            $table->string('district');
            $table->string('city');
            $table->string('khan');
            $table->string('full_address');
            $table->string('zipcode');
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
