<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mobil_model extends Model
{
    protected $table="mobil";
    protected $primaryKey="id";
    protected $fillable = [
      'id_jenis_mobil', 'nama_mobil', 'plat_nomor', 'kondisi'
    ];
}
