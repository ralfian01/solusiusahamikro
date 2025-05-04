<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teknisi extends Authenticatable
{
    use HasFactory;

    protected $table = "teknisi"; //cek
    protected $primaryKey = "id"; //cek

    protected $fillable = [
        'id', 'nama', 'jabatan', 'nipp', 'email', 'password', 'ttd', 'foto','status','status_aktivasi','kode_aktivasi','limit_trial'
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
