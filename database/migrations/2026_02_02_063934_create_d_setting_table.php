<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_setting', function (Blueprint $table) {
            $table->id();
            
            // Welcome section
            $table->string('selamat_datang')->nullable();
            $table->string('head_welcome')->nullable();
            $table->text('informasi')->nullable();
            $table->text('profil')->nullable();
            
            // Registration dates
            $table->string('ta_pendaftaran')->nullable();
            $table->date('buka_pendaftaran')->nullable();
            $table->date('tutup_pendaftaran')->nullable();
            $table->date('daftar_ulang_awal')->nullable();
            $table->date('daftar_ulang_akhir')->nullable();
            
            // Fees
            $table->integer('biaya_pendaftaran')->default(0);
            $table->integer('biaya_spp')->default(0);
            $table->integer('biaya_pendidikan')->default(0);
            $table->integer('biaya_almamater')->default(0);
            $table->integer('biaya_lain')->default(0);
            
            // Bank details
            $table->string('nama_bank')->nullable();
            $table->string('nama_rekening')->nullable();
            $table->string('nomor_rekening')->nullable();
            
            // Assets
            $table->string('bg_head')->nullable();
            $table->string('logo_app')->nullable();
            
            // Other settings
            $table->string('link_syarat_daftar_ulang')->nullable();
            $table->string('instansi')->nullable();
            $table->string('kontak_nama')->nullable();
            $table->string('kontak_hp')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_setting');
    }
};
