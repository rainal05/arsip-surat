<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class S_keluar extends Model
{
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kode()
    {
        return $this->belongsTo(Kode::class);
    }
}
