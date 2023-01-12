<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MO extends Model
{
    use HasFactory;
    protected $table = "mo";
    protected $primaryKey = 'kode_mo';
    public $incrementing = false;
    protected $fillable = ['kode_mo','kode_bom','kuantitas', 'tanggal', 'status'];
    public $timestamps = false;
}
