<?php
namespace App\Controllers;

// Menghubungkan file controller dengan model Kabupaten
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
use App\Models\SekolahModel;

class Dashboard extends BaseController
{
    // Method index otomatis dipanggil oleh controller
    public function index()
    {
        // Inisiasi objek dari class KabupatenModel
        $kabupaten = new KabupatenModel();
        // Ambil data dari tabel kabupaten, id_kabupaten = 1
        $data['kabupaten'] = $kabupaten->find(1);

        // Inisiasi objek dari class SekolahModel
        $sekolah = new SekolahModel();
        // Mengambil semua data sekolah
        $query = $sekolah->findAll();
        $lokasi = '';
        $label_lokasi = '';

        // Perulangan untuk mempersiapkan data marker
        foreach ($query as $data_sekolah) {
            $lokasi .= '["' . $data_sekolah->npsn . '" ,"'
                . $data_sekolah->nama_sekolah . '","'
                . $data_sekolah->alamat_sekolah . '","'
                . $data_sekolah->jenjang_pendidikan . '","'
                . $data_sekolah->status . '", '
                . $data_sekolah->koordinat . '],';
        }

        $data['marker'] = $lokasi;
        echo view('dashboard', $data);
    }

    // Function untuk menampilkan data kecamatan
    public function getdata()
    {
        // Inisiasi objek dari class KecamatanModel
        $kecamatan = new KecamatanModel();
        // Mengambil kode_kecamatan yang dikirim oleh AJAX
        $kode_kecamatan = $this->request->getGet('kode_kecamatan');
        // Melakukan pencarian ke tabel kecamatan berdasarkan kode kecamatan
        $data = $kecamatan->find($kode_kecamatan);

        // Jika data ditemukan, persiapkan data kecamatan
        if (!empty($data)) {
            $hasil = '<tr><td width="45%">Kode Kecamatan</td><td>:</td><td>'
                . $data->kode_kecamatan . '</td></tr>'
                . '<tr><td>Nama Kecamatan</td><td>:</td><td>'
                . $data->nama_kecamatan . '</td></tr>'
                . '<tr><td>Jumlah Penduduk</td><td>:</td><td>'
                . number_format($data->jumlah_penduduk, 0, ',', '.') . ' Jiwa</td></tr>'
                . '<tr><td>Luas Wilayah</td><td>:</td><td>'
                . number_format($data->luas_wilayah, 0, ',', '.') . ' Km<sup>2</sup></td></tr>';
        } else {
            // Jika data tidak ditemukan, tampilkan pesan
            $hasil = '<tr><td class="text-center" colspan="3">DATA TIDAK ADA!</td></tr>';
        }

        // Persiapkan array data
        $respon = ['hasil' => $hasil];
        // Kembalikan dalam bentuk JSON
        return $this->response->setJSON($respon);
    }
}
?>