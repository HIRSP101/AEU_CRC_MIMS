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
        Schema::create('branch_hei', function (Blueprint $table) {
            $table->bigIncrements('bhei_id')->primary();
            $table->string('institution_name', 50);
            $table->string('institution_kh', 50);
            $table->string('type', 50);
            $table->string('image', 100);
            $table->string('village', 50);
            $table->string('commune_sangkat', 50);
            $table->string('district_khan', 50);
            $table->string('province_city', 50);
            $table->date('registered_at');
            $table->date('established_at');
            $table->string('institute_type', 50);
            $table->string('position');
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
