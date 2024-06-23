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
            $table->string('jenis_kelamin')->nullable();
            $table->date('ttl')->nullable();
            $table->string('sekolah')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('tinggi')->nullable();
            $table->string('no_hp')->nullable();
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('ktp')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('transkip_nilai')->nullable();
            $table->string('cv')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('jurusan_id')->references('id')->on('jurusans');
            $table->foreign('user_id')->references('id')->on('users');

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
