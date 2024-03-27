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
        Schema::create('ninjas', function (Blueprint $table) {
            $table->id();
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('prov');
            $table->string('region');
            $table->string('cilacap');
            $table->string('jakarta');
            $table->string('surabaya');
            $table->string('medan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ninjas');
    }
};
