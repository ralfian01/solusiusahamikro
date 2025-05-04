<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NoTelepon extends Model
{
    use HasFactory;

    protected $table = 'no_telepon';

    protected $fillable = [
        'nomor',
        'notifikasi',
        'owner_id',
        'owner_type',
    ];

    public function owner()
    {
        return $this->morphTo();
    }

}
