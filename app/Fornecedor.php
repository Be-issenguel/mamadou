<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fornecimentos()
    {
        return $this->hasMany(Fornecimento::class);
    }
}
