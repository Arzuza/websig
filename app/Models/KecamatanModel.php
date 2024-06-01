<?php 

namespace App\Models;

use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $table = 'kecamatan'; // Nama tabel
    protected $primaryKey = 'kode_kecamatan'; // Primary key tabel
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $useAutoIncrement = true;

    // Nama semua field pada tabel
    protected $allowedFields = [
        'kode_kecamatan', 
        'id_kabupaten', 
        'nama_kecamatan', 
        'jumlah_penduduk', 
        'luas_wilayah'
    ];
    
    protected $skipValidation = true;
}

?>
