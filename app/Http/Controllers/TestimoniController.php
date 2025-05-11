<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Menampilkan daftar testimoni.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $testimoniData = [
            [
                'id' => 1,
                'nama' => 'MAULANA PRATAMA',
                'isi_testimoni' => '"Magang di PT Garuda Cyber Indonesia merupakan pengalaman yang sangat berharga bagi saya. Selama magang, saya mendapatkan kesempatan untuk mendalami berbagai teknologi pengembangan perangkat lunak serta memahami proses kerja di industri IT secara langsung. Bimbingan dari mentor yang berpengalaman membantu saya meningkatkan keterampilan teknis, seperti coding, debugging, dan pengelolaan proyek, serta soft skill seperti kerja tim dan komunikasi. Selain itu, lingkungan kerja yang profesional dan suportif mendorong saya untuk terus belajar dan berkembang. Magang ini telah memberikan wawasan yang luas dan kesiapan untuk terjun ke dunia industri teknologi informasi."',
                'foto' => 'https://via.placeholder.com/150/FFC107/000000?Text=Foto+1',
                'instansi' => 'SMK 12 Pekanbaru',
                'posisi' => 'Programmer',
            ],
            [
                'id' => 2,
                'nama' => 'AGUNG',
                'isi_testimoni' => '"Testimoni kedua dari Agung dengan pengalaman yang berbeda..."',
                'foto' => 'https://via.placeholder.com/150/2196F3/FFFFFF?Text=Foto+2',
                'instansi' => 'Universitas Islam Riau',
                'posisi' => 'System Analyst',
            ],
            // Tambahkan data testimoni lain di sini
        ];

        return view('pages.testimoni.index', compact('testimoniData'));
    }

    /**
     * (Opsional) Metode untuk menampilkan detail testimoni (jika Anda menggunakan AJAX).
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Di sini Anda akan mengambil detail testimoni dari database berdasarkan ID.
        $testimoni = collect([
            [
                'id' => 1,
                'nama' => 'MAULANA PRATAMA',
                'isi_testimoni' => '"Magang di PT Garuda Cyber Indonesia merupakan pengalaman yang sangat berharga bagi saya. Selama magang, saya mendapatkan kesempatan untuk mendalami berbagai teknologi pengembangan perangkat lunak serta memahami proses kerja di industri IT secara langsung. Bimbingan dari mentor yang berpengalaman membantu saya meningkatkan keterampilan teknis, seperti coding, debugging, dan pengelolaan proyek, serta soft skill seperti kerja tim dan komunikasi. Selain itu, lingkungan kerja yang profesional dan suportif mendorong saya untuk terus belajar dan berkembang. Magang ini telah memberikan wawasan yang luas dan kesiapan untuk terjun ke dunia industri teknologi informasi."',
                'foto' => 'https://via.placeholder.com/150/FFC107/000000?Text=Foto+1',
                'instansi' => 'SMK 12 Pekanbaru',
                'posisi' => 'Programmer',
            ],
            [
                'id' => 2,
                'nama' => 'AGUNG',
                'isi_testimoni' => '"Testimoni kedua dari Agung dengan pengalaman yang berbeda..."',
                'foto' => 'https://via.placeholder.com/150/2196F3/FFFFFF?Text=Foto+2',
                'instansi' => 'Universitas Islam Riau',
                'posisi' => 'System Analyst',
            ],
        ])->firstWhere('id', $id);

        if ($testimoni) {
            return response()->json($testimoni);
        } else {
            return response()->json(['error' => 'Testimoni tidak ditemukan.'], 404);
        }
    }
}