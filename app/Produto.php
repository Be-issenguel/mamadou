<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendas()
    {
        return $this->belongsToMany(Venda::class);
    }

    public function fornecimentos()
    {
        return $this->belongsToMany(Fornecimento::class);
    }
}
