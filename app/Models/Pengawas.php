<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengawas extends Authenticatable
{
    use HasFactory;
    protected $table = "pengawas"; //cek
    protected $primaryKey = "id"; //cek

    protected $fillable = [
        'id', 'nama', 'nipp', 'email', 'password','ttd','status','jabatan','status_aktivasi','kode_aktivasi'
    ];

    protected $hidden = [
        'password',
    ];

    public function logAktivasi()
    {
        return $this->morphMany(LogAktivasi::class, 'relatable');
    }

    public function noTelepon()
    {
        return $this->hasMany(NoTelepon::class, 'owner_id');
    }
}
