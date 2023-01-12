<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['nama', 'kode', 'harga', 'stok', 'gambar'];
    public $timestamps = false;
}
