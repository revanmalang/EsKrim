<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'vendor';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['nama', 'kontak', 'alamat'];
    public $timestamps = false;
}
