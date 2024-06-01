<?php
namespace App\Controllers;

use App\Models\KecamatanModel;
use App\Models\SekolahModel;

class Sekolah extends BaseController
{
    public function index()
    {
        $this->tampil(); // Memanggil method tampil
    }

    public function tampil()
    {
        $sekolah = new SekolahModel();
        // Mengambil semua data di tabel sekolah dan kecamatan menggunakan JOIN
        $data['query'] = $sekolah->join('kecamatan', 'kecamatan.kode_kecamatan = sekolah.kode_kecamatan')->findAll();
        // Mengambil nilai variabel msg pada session flashdata
        $data['msg'] = session()->getFlashdata('msg');
        // Memanggil file view tampil
        echo view('sekolah/tampil', $data);
    }

    public function tambah()
    {
        $kecamatanModel = new KecamatanModel();
        $kecamatan = $kecamatanModel->findAll();
        $kecamatanOptions = array();
        // Mempersiapkan variabel array
        $kecamatanOptions[''] = 'belum dipilih';
        // Perulangan untuk menghasilkan option value di dropdown kecamatan
        foreach ($kecamatan as $row) {
            $kecamatanOptions[$row->kode_kecamatan] = strtoupper($row->nama_kecamatan);
        }
        // Variabel untuk list dropdown kecamatan
        $data['kecamatanOptions'] = $kecamatanOptions;
        $data['statusOptions'] = ['' => 'Belum Dipilih', 'NEGERI' => 'NEGERI', 'SWASTA' => 'SWASTA'];
        $data['jenjangOptions'] = [
            '' => 'Belum Dipilih',
            'SD' => 'SD',
            'SMP' => 'SMP',
            'SMA' => 'SMA',
            'SMK' => 'SMK',
        ];
        // Memanggil view form tambah
        return view('sekolah/tambah', $data);
    }

    public function edit($npsn)
    {
        $kecamatanModel = new KecamatanModel();
        $kecamatan = $kecamatanModel->findAll();
        $kecamatanOptions = array();
        $kecamatanOptions[''] = 'belum dipilih';
        foreach ($kecamatan as $row) {
            $kecamatanOptions[$row->kode_kecamatan] = strtoupper($row->nama_kecamatan);
        }
        $data['kecamatanOptions'] = $kecamatanOptions;
        $data['statusOptions'] = ['' => 'Belum Dipilih', 'NEGERI' => 'NEGERI', 'SWASTA' => 'SWASTA'];
        $data['jenjangOptions'] = [
            '' => 'Belum Dipilih',
            'SD' => 'SD',
            'SMP' => 'SMP',
            'SMA' => 'SMA',
            'SMK' => 'SMK',
        ];
        $sekolahModel = new SekolahModel();
        // Mengambil data sekolah sesuai nilai pada $npsn
        $data['query'] = $sekolahModel->find($npsn);
        // Mengirimkan id yang berisi nilai $npsn sebagai acuan untuk update data di method update()
        $data['id'] = $npsn;

        return view('sekolah/edit', $data);
    }

    public function simpan()
    {
        $sekolahModel = new SekolahModel();
        // Mengambil data dari masing-masing input pada form tambah dan disimpan pada array untuk disimpan ke tabel sekolah
        $data_sekolah = [
            'npsn' => $this->request->getVar('npsn'),
            'kode_kecamatan' => $this->request->getVar('kode_kecamatan'),
            'nama_sekolah' => $this->request->getVar('nama_sekolah'),
            'alamat_sekolah' => $this->request->getVar('alamat_sekolah'),
            'status' => $this->request->getVar('status'),
            'jenjang_pendidikan' => $this->request->getVar('jenjang_pendidikan'),
            'koordinat' => $this->request->getVar('koordinat')
        ];
        // Menggunakan query builder insert untuk menyimpan ke tabel sekolah
        $sekolahModel->insert($data_sekolah);
        // Method affectedRows() mengembalikan nilai 1 jika insert berhasil, nilai 0 jika gagal
        if ($sekolahModel->affectedRows() > 0) {
            // Persiapkan pesan jika insert berhasil
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil disimpan!</div>';
        } else {
            // Persiapkan pesan jika insert gagal
            $msg = '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>';
        }
        // Mengirimkan nilai msg melalui flashdata, flashdata adalah session sekali pakai
        session()->setFlashdata('msg', $msg);
        // Memanggil index pada controller sekolah, tujuannya agar setelah simpan, tampilan kembali ke tabel CRUD
        return redirect()->to('sekolah');
    }

    public function update()
    {
        $sekolahModel = new SekolahModel();
        // Mengambil input hidden id dari form edit
        $id = $this->request->getVar('id');
        $data_sekolah = [
            'npsn' => $this->request->getVar('npsn'),
            'kode_kecamatan' => $this->request->getVar('kode_kecamatan'),
            'nama_sekolah' => $this->request->getVar('nama_sekolah'),
            'alamat_sekolah' => $this->request->getVar('alamat_sekolah'),
            'status' => $this->request->getVar('status'),
            'jenjang_pendidikan' => $this->request->getVar('jenjang_pendidikan'),
            'koordinat' => $this->request->getVar('koordinat')
        ];
        // Menggunakan query builder update untuk mengubah data di tabel kecamatan berdasarkan id (kode kecamatan)
        $sekolahModel->update($id, $data_sekolah);
        if ($sekolahModel->affectedRows() > 0) {
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil disimpan!</div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>';
        }
        session()->setFlashdata('msg', $msg);
        return redirect()->to('sekolah');
    }

    public function hapus($npsn)
    {
        $sekolahModel = new SekolahModel();
        // Menggunakan query builder delete untuk menghapus data di tabel sekolah sesuai npsn
        $sekolahModel->delete(['npsn' => $npsn]);
        if ($sekolahModel->affectedRows() > 0) {
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil dihapus!</div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">Data gagal dihapus!</div>';
        }
        session()->setFlashdata('msg', $msg);
        return redirect()->to('sekolah');
    }
}
?>