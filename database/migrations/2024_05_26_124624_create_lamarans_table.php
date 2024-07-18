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
        Schema::create('lamarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelamar_id');
            $table->unsignedBigInteger('lowongan_id');
            $table->date('tanggal');
            $table->enum('status',['Menunggu', 'Diterima','Ditolak'])->default('Menunggu');
            $table->timestamps();
            // Foreign keys
            $table->foreign('pelamar_id')->references('id')->on('pelamars');
            $table->foreign('lowongan_id')->references('id')->on('lowongans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamarans');
    }
};
