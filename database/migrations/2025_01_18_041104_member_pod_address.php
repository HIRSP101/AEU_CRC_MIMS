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
        Schema::create('member_pod_address', function (Blueprint $table) {
            $table->bigIncrements('mpa_id')->primary();
            $table->int('member_id');
            $table->string('village', 45);
            $table->string('commune_sangkat', 45);
            $table->string('district_khan', 45);
            $table->string('province_city', 45);
            $table->string('zipcode', 45);
            $table->string('home_no');
            $table->string('street_no');
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
