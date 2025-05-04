<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = "menu";
    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'nama', 'route', 'c', 'r', 'u', 'o', 'cc', 'cr', 'cu', 'co'
    ]; 
}
