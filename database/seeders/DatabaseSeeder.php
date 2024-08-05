<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\KriteriaPenyakitMenular;
use App\Models\PromosiKesehatanHewan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            [
                'name' => 'Richard Alexander',
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 1,
            ],
            [
                'name' => 'Rizky Fauzi',
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 1,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@medi.care',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 2,
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $kriterias = [
            [
                'nama' => 'Rabies',
                'deskripsi' => 'Rabies adalah penyakit viral yang sangat mematikan, yang menyerang sistem saraf pusat. Penyakit ini biasanya ditularkan melalui gigitan atau cakaran hewan yang terinfeksi, seperti anjing, kucing, dan kelelawar. Gejala awal meliputi demam, sakit kepala, dan kelemahan umum, diikuti oleh gejala neurologis seperti agresivitas, hidrofobia (takut air), kejang, dan paralisis. Setelah gejala klinis muncul, rabies hampir selalu berakibat fatal. Vaksinasi hewan peliharaan adalah cara utama pencegahan.',
                'penularan' => 'melalui gigitan atau cakaran hewan yang terinfeksi',
                'img' => 'rabies-img',
            ],
            [
                'nama' => 'Brucellosis',
                'deskripsi' => 'Brucellosis adalah infeksi bakteri yang dapat menular dari hewan ke manusia, terutama melalui kontak langsung dengan cairan tubuh hewan yang aborsi, infertilitas, dan penurunan produksi susu. Pada manusia, gejala termasuk demam, keringat malam, nyeri sendi, dan kelelahan. Pencegahan melibatkan vaksinasi ternak dan praktik kebersihan yang baik.',
                'penularan' => 'kontak langsung dengan cairan tubuh hewan yang terinfeksi, konsumsi produk susu yang tidak dipasteurisasi',
                'img' => 'brucellosis.png',
            ],
            [
                'nama' => 'Leptospirosis',
                'deskripsi' => 'Leptospirosis adalah penyakit bakteri yang ditularkan melalui kontak dengan air atau tanah yang terkontaminasi urin hewan yang terinfeksi, seperti tikus, anjing, dan ternak. Gejala pada hewan dapat bervariasi dari ringan hingga berat, termasuk demam, nyeri otot, gagal ginjal, dan jaundice (penyakit kuning). Pada manusia, gejala mirip dengan flu dan dapat berkembang menjadi penyakit serius seperti meningitis atau gagal hati dan ginjal. Vaksinasi hewan dan kontrol terhadap tikus adalah langkah pencegahan yang penting.',
                'penularan' => 'melalui kontak dengan air atau tanah yang terkontaminasi urin hewan yang terinfeksi',
                'img' => 'Leptospirosis.png',
            ],
            [
                'nama' => 'Parvovirus',
                'deskripsi' => 'Parvovirus adalah penyakit viral yang sangat menular yang terutama menyerang anjing, khususnya anak anjing. Virus ini ditularkan melalui kontak dengan feses hewan yang terinfeksi atau objek yang terkontaminasi. Gejala termasuk muntah, diare berdarah, dehidrasi, dan penurunan berat badan yang cepat. Parvovirus dapat berakibat fatal, terutama pada anak anjing yang tidak divaksinasi. Vaksinasi rutin adalah cara terbaik untuk mencegah penyakit ini.',
                'penularan' => 'kontak langsung dengan feses hewan yang terinfeksi atau kontak tidak langsung melalui objek yang terkontaminasi',
                'img' => 'Parvovirus.jpg',
            ],
        ];

        foreach ($kriterias as $kriteria) {
            KriteriaPenyakitMenular::create($kriteria);
        }


        $promosi1 = [
            'judul' => 'Vaksinasi Rutin dan Cek Kesehatan Berkala',
            'deskripsi' => 'Vaksinasi dapat mencegah berbagai penyakit menular seperti rabies, parvovirus, dan leptospirosis. Pemilik hewan diajak untuk mengikuti jadwal vaksinasi yang direkomendasikan oleh dokter hewan dan melakukan cek kesehatan rutin setidaknya sekali dalam setahun. Pemeriksaan berkala membantu mendeteksi masalah kesehatan sejak dini sehingga dapat segera ditangani.',
            'img' => 'vaksinasi-kucing.jpg',
        ];

        $promosi2 = [
            'judul' => 'Sterilisasi Hewan Peliharaan',
            'deskripsi' => 'Sterilisasi tidak hanya membantu mengendalikan populasi hewan liar tetapi juga mengurangi risiko penyakit tertentu seperti kanker rahim dan testis. Promosi ini menekankan manfaat kesehatan dari sterilisasi dan memberikan informasi tentang prosedur serta perawatan pasca-operasi.',
            'img' => 'sterilisasi.jpg',
        ];

        $promosi3 = [
            'judul' => 'Pentingnya Kebersihan dan Sanitasi',
            'deskripsi' => 'Dengan rutin membersihkan kandang, tempat tidur, dan area bermain hewan untuk mencegah penularan penyakit. Selain itu, penting untuk memastikan hewan mendapatkan air bersih dan makanan yang sehat.',
            'img' => 'kebersihan.png',
        ];

        $promosis = [$promosi1, $promosi2, $promosi3];

        foreach ($promosis as $promosi) {
            PromosiKesehatanHewan::create($promosi);
        }



    }
}
