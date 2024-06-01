<?php 

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table = 'sekolah'; // Nama tabel
    protected $primaryKey = 'npsn'; // Primary key tabel
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $useAutoIncrement = false;

    // Nama semua field pada tabel
    protected $allowedFields = [
        'npsn',
        'kode_kecamatan',
        'nama_sekolah',
        'alamat_sekolah',
        'status',
        'jenjang_pendidikan',
        'koordinat'
    ];

    protected $skipValidation = true;
}

?>