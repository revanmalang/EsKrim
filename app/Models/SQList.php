<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SQList extends Model
{
    use HasFactory;
    protected $table = "sq_list";
    protected $primaryKey = 'kode_sq_list';
    public $incrementing = false;
    protected $fillable = ['kode_sq_list', 'kode_sq','kode_produk','kuantitas'];
    public $timestamps = false;
}
