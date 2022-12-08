<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $guarded = [];

    public function smasuk()
    {
        return $this->belongsTo(S_masuk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keperluan()
    {
        return $this->belongsTo(Keperluan::class);
    }
}
