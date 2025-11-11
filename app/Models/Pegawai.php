<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pegawai extends Model
{
    protected $guarded = [];

    public function administrasi(): HasOne
    {
        return $this->hasOne(Administrasi::class);
    }

     public function riwayat(): HasOne
    {
        return $this->hasOne(Riwayat::class);
    }

     public function sk(): HasOne
    {
        return $this->hasOne(Sk::class);
    }

    public function skiv(): HasOne
    {
        return $this->hasOne(Skiv::class);
    }

     public function skps(): HasMany
    {
        return $this->hasMany(Skp::class);
    }
}
