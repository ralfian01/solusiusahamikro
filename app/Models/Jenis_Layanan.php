<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_Layanan extends Model
{
    use HasFactory;
    protected $table = "jenis_layanan";
    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'nama', 'kat_layanan'
    ]; 
}
