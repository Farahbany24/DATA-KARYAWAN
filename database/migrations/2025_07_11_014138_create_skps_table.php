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
        Schema::create('skps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->integer('tahun')->nullable();
            $table->string('file_skp', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skps');
    }
};
