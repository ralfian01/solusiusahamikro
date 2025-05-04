<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;
    protected $table = "privilege";
    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'menu', 'c', 'r', 'u', 'o', 'role'
    ]; 
}
