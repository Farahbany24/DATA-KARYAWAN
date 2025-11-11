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
        Schema::create('sks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('skiii_a', 255)->nullable();
            $table->string('skiii_b', 255)->nullable();
            $table->string('skiii_c', 255)->nullable();
            $table->string('skiii_d', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sks');
    }
};
