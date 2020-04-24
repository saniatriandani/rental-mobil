<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pelanggan_model extends Model
{
    protected $table="pelanggan";
    protected $primaryKey="id";
    protected $fillable = [
      'nama_pelanggan', 'alamat_pelanggan', 'telp', 'no_ktp', 'foto'
    ];
}
