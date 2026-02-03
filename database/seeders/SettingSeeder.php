<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_setting')->insert([
            'id' => 1,
            'selamat_datang' => 'Selamat Datang di Portal Pendaftaran',
            'head_welcome' => 'Pendaftaran Online',
            'informasi' => '<p>Silakan lengkapi formulir pendaftaran dengan data yang valid.</p>',
            'profil' => '<p>Profil institusi akan ditampilkan di sini.</p>',
            'ta_pendaftaran' => '2026/2027',
            'buka_pendaftaran' => now()->format('Y-m-d'),
            'tutup_pendaftaran' => now()->addMonths(3)->format('Y-m-d'),
            'daftar_ulang_awal' => now()->addMonths(4)->format('Y-m-d'),
            'daftar_ulang_akhir' => now()->addMonths(5)->format('Y-m-d'),
            'biaya_pendaftaran' => 200000,
            'biaya_spp' => 500000,
            'biaya_pendidikan' => 3000000,
            'biaya_almamater' => 150000,
            'biaya_lain' => 0,
            'nama_bank' => 'Bank BRI',
            'nama_rekening' => 'Yayasan Pendidikan',
            'nomor_rekening' => '0000000000',
            'instansi' => 'STIKES Pelita Ibu',
            'kontak_nama' => 'Admin',
            'kontak_hp' => '08123456789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
