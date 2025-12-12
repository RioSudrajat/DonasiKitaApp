<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use Carbon\Carbon;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campaigns = [
            [
                'title' => 'Beasiswa Pendidikan Anak Yatim',
                'description' => "Program beasiswa untuk anak yatim dan kurang mampu agar dapat melanjutkan pendidikan ke jenjang yang lebih tinggi.\n\nDengan bantuan Anda, kami dapat memberikan:\n- Biaya sekolah penuh selama 1 tahun\n- Perlengkapan sekolah lengkap\n- Bimbingan belajar gratis\n- Uang saku bulanan\n\nMari bersama-sama wujudkan mimpi mereka untuk mendapatkan pendidikan yang layak!",
                'target_amount' => 100000000,
                'current_amount' => 75000000,
                'end_date' => Carbon::now()->addMonths(2),
                'status' => 'active',
                'donors_count' => 150,
            ],
            [
                'title' => 'Bantuan Kesehatan Masyarakat Terpencil',
                'description' => "Program kesehatan gratis untuk masyarakat di daerah terpencil yang sulit mengakses layanan kesehatan.\n\nProgram meliputi:\n- Pemeriksaan kesehatan gratis\n- Pemberian obat-obatan\n- Penyuluhan kesehatan\n- Posyandu keliling\n- Operasi katarak gratis\n\nBantu mereka mendapatkan akses kesehatan yang layak!",
                'target_amount' => 80000000,
                'current_amount' => 48000000,
                'end_date' => Carbon::now()->addMonths(3),
                'status' => 'active',
                'donors_count' => 98,
            ],
            [
                'title' => 'Reboisasi dan Pelestarian Hutan',
                'description' => "Program penanaman pohon dan pelestarian hutan untuk menjaga kelestarian alam dan mencegah bencana.\n\nTarget program:\n- Menanam 10.000 pohon\n- Edukasi lingkungan untuk warga\n- Pembuatan biopori\n- Pengelolaan sampah organik\n\nSetiap Rp 50.000 dapat menanam 10 pohon!",
                'target_amount' => 50000000,
                'current_amount' => 20000000,
                'end_date' => Carbon::now()->addMonths(4),
                'status' => 'active',
                'donors_count' => 67,
            ],
            [
                'title' => 'Bantuan Pangan untuk Keluarga Prasejahtera',
                'description' => "Distribusi paket sembako untuk keluarga prasejahtera yang terdampak ekonomi.\n\nSetiap paket berisi:\n- Beras 10kg\n- Minyak goreng 2L\n- Gula 1kg\n- Telur 1kg\n- Mi instan 1 dus\n- Susu 2 kotak\n\nTarget: 500 keluarga\nRp 200.000 = 1 paket sembako",
                'target_amount' => 100000000,
                'current_amount' => 35000000,
                'end_date' => Carbon::now()->addMonth(),
                'status' => 'active',
                'donors_count' => 45,
            ],
        ];

        foreach ($campaigns as $campaign) {
            Campaign::create($campaign);
        }
    }
}
