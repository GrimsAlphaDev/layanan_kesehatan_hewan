<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PromosiKesehatanHewan>
 */
class PromosiKesehatanHewanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $promosi = [

            [
                'judul' => 'Vaksinasi Rutin dan Cek Kesehatan Berkala',
                'deskripsi' => 'Vaksinasi dapat mencegah berbagai penyakit menular seperti rabies, parvovirus, dan leptospirosis. Pemilik hewan diajak untuk mengikuti jadwal vaksinasi yang direkomendasikan oleh dokter hewan dan melakukan cek kesehatan rutin setidaknya sekali dalam setahun. Pemeriksaan berkala membantu mendeteksi masalah kesehatan sejak dini sehingga dapat segera ditangani.',
                'img' => 'vaksinasi-kucing.jpg',
            ],
            [
                'judul' => 'Sterilisasi Hewan Peliharaan',
                'deskripsi' => 'Sterilisasi tidak hanya membantu mengendalikan populasi hewan liar tetapi juga mengurangi risiko penyakit tertentu seperti kanker rahim dan testis. Promosi ini menekankan manfaat kesehatan dari sterilisasi dan memberikan informasi tentang prosedur serta perawatan pasca-operasi.',
                'img' => 'sterilisasi.jpg',
            ],
            [
                'judul' => 'Pentingnya Kebersihan dan Sanitasi',
                'deskripsi' => 'Dengan rutin membersihkan kandang, tempat tidur, dan area bermain hewan untuk mencegah penularan penyakit. Selain itu, penting untuk memastikan hewan mendapatkan air bersih dan makanan yang sehat.',
                'img' => 'kebersihan.png',
            ]
        ];

        return $promosi;

    }
}
