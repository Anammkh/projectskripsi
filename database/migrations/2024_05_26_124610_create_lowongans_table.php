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
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('batas_waktu');
            $table->string('posisi');
            $table->text('persyaratan');
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('mitra_id');
            $table->unsignedBigInteger('skil_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('cascade');
            $table->foreign('mitra_id')->references('id')->on('mitras')->onDelete('cascade');
            $table->foreign('skil_id')->references('id')->on('skils')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};
