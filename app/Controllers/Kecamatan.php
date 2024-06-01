<?php
namespace App\Controllers;

use App\Models\KabupatenModel;
use App\Models\KecamatanModel;

class Kecamatan extends BaseController
{
    public function index()
    {
        $this->tampil(); // Memanggil method tampil
    }

    public function tampil()
    {
        $kecamatan = new KecamatanModel();
        // Mengambil semua data di tabel kecamatan
        $data['query'] = $kecamatan->findAll();
        // Mengambil nilai variabel msg pada session flashdata
        $data['msg'] = session()->getFlashdata('msg');
        // Memanggil file view tampil
        echo view('kecamatan/tampil', $data);
    }

    public function tambah()
    {
        $kabupatenModel = new KabupatenModel();
        $kabupaten = $kabupatenModel->findAll();
        $kabupatenOptions = array();
        // Mempersiapkan variabel array
        $kabupatenOptions[''] = 'belum dipilih';
        // Perulangan untuk menghasilkan option value di dropdown kabupaten
        foreach ($kabupaten as $row) {
            $kabupatenOptions[$row->id_kabupaten] = strtoupper($row->nama_kabupaten);
        }
        // Variabel untuk list dropdown kabupaten
        $data['kabupatenOptions'] = $kabupatenOptions;
        // Memanggil view form tambah
        return view('kecamatan/tambah', $data);
    }

    public function edit($kode_kecamatan)
    {
        $kabupatenModel = new KabupatenModel();
        $kabupaten = $kabupatenModel->findAll();
        $kabupatenOptions = array();
        $kabupatenOptions[''] = 'belum dipilih';
        foreach ($kabupaten as $row) {
            $kabupatenOptions[$row->id_kabupaten] = strtoupper($row->nama_kabupaten);
        }
        $data['kabupatenOptions'] = $kabupatenOptions;

        $kecamatanModel = new KecamatanModel();
        // Mengambil data kecamatan sesuai nilai pada $kode_kecamatan
        $data['query'] = $kecamatanModel->find($kode_kecamatan);
        // Mengirimkan id yang berisi nilai $kode_kecamatan sebagai acuan untuk update data di method update()
        $data['id'] = $kode_kecamatan;

        return view('kecamatan/edit', $data);
    }

    public function simpan()
    {
        $kecamatanModel = new KecamatanModel();
        // Mengambil data dari masing-masing input pada form tambah dan disimpan pada array untuk disimpan ke tabel kecamatan
        $data_kecamatan = [
            'kode_kecamatan' => $this->request->getVar('kode_kecamatan'),
            'id_kabupaten' => $this->request->getVar('id_kabupaten'),
            'nama_kecamatan' => $this->request->getVar('nama_kecamatan'),
            'jumlah_penduduk' => $this->request->getVar('jumlah_penduduk'),
            'luas_wilayah' => $this->request->getVar('luas_wilayah')
        ];
        // Menggunakan query builder insert untuk menyimpan ke tabel kecamatan
        $kecamatanModel->insert($data_kecamatan);
        // Method affectedRows() mengembalikan nilai 1 jika insert berhasil, nilai 0 jika gagal
        if ($kecamatanModel->affectedRows() > 0) {
            // Persiapkan pesan jika insert berhasil
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil disimpan!</div>';
        } else {
            // Persiapkan pesan jika insert gagal
            $msg = '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>';
        }
        // Mengirimkan nilai msg melalui flashdata, flashdata adalah session sekali pakai
        session()->setFlashdata('msg', $msg);
        // Memanggil index pada controller kecamatan, tujuannya agar setelah simpan, tampilan kembali ke tabel CRUD
        return redirect()->to('kecamatan');
    }

    public function update()
    {
        $kecamatanModel = new KecamatanModel();
        // Mengambil input hidden id dari form edit
        $id = $this->request->getVar('id');
        $data_kecamatan = [
            'kode_kecamatan' => $this->request->getVar('kode_kecamatan'),
            'id_kabupaten' => $this->request->getVar('id_kabupaten'),
            'nama_kecamatan' => $this->request->getVar('nama_kecamatan'),
            'jumlah_penduduk' => $this->request->getVar('jumlah_penduduk'),
            'luas_wilayah' => $this->request->getVar('luas_wilayah')
        ];
        // Menggunakan query builder update untuk mengubah data di tabel kecamatan berdasarkan id (kode kecamatan)
        $kecamatanModel->update($id, $data_kecamatan);
        if ($kecamatanModel->affectedRows() > 0) {
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil disimpan!</div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>';
        }
        session()->setFlashdata('msg', $msg);
        return redirect()->to('kecamatan');
    }

    public function hapus($kode_kecamatan)
    {
        $kecamatanModel = new KecamatanModel();
        // Menggunakan query builder delete untuk menghapus data di tabel kecamatan sesuai kode kecamatan
        $kecamatanModel->delete(['kode_kecamatan' => $kode_kecamatan]);
        if ($kecamatanModel->affectedRows() > 0) {
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil dihapus!</div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">Data gagal dihapus!</div>';
        }
        session()->setFlashdata('msg', $msg);
        return redirect()->to('kecamatan');
    }
}
?>