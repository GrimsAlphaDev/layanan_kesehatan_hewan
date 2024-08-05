<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KriteriaPenyakitMenular>
 */
class KriteriaPenyakitMenularFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
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

        return $kriterias;
    }
}
