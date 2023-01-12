<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SQ extends Model
{
    use HasFactory;
    protected $table = "sq";
    protected $primaryKey = 'kode_sq';
    public $incrementing = false;
    protected $fillable = ['kode_sq', 'kode_pembeli', 'tanggal_order', 'status', 'total_harga', 'metode_pembayaran'];
    public $timestamps = false;
}
