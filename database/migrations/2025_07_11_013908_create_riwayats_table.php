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
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('sk_cpns', 255)->nullable();
            $table->string('sk_pns', 255)->nullable();
            $table->string('sk_jab_struktural', 255)->nullable();
            $table->string('konversi_nip', 255)->nullable();
            $table->string('spmt', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
