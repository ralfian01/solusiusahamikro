<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kat_Layanan extends Model
{
    use HasFactory;
    protected $table = "kat_layanan";
    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'nama'
    ]; 
}
