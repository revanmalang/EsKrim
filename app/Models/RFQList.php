<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFQList extends Model
{
    use HasFactory;
    protected $table = "rfq_list";
    protected $primaryKey = 'kode_rfq_list';
    public $incrementing = false;
    protected $fillable = ['kode_rfq_list', 'kode_rfq','kode_bahan','kuantitas', 'satuan'];
    public $timestamps = false;
}
