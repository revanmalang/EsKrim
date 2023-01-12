<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BOMList extends Model
{
    use HasFactory;
    protected $table = "bom_list";
    protected $primaryKey = 'kode_bom_list';
    public $incrementing = false;
    protected $fillable = ['kode_bom','kode_bahan','kuantitas', 'satuan'];
    public $timestamps = false;
}
