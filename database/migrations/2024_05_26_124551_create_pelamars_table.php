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
        Schema::create('pelamars', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kelamin');
            $table->date('ttl');
            $table->string('sekolah');
            $table->text('alamat');
            $table->integer('tinggi');
            $table->string('no_hp');
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('user_id');
            $table->string('ktp');
            $table->string('ijazah');
            $table->string('transkip_nilai');
            $table->string('cv');
            $table->unsignedBigInteger('skil_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('jurusan_id')->references('id')->on('jurusans');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('skil_id')->references('id')->on('skils');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamars');
    }
};
