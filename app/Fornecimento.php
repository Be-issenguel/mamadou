<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecimento extends Model
{
    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class);
    }

    public function produtos(){
        return $this->belongsToMany(Produto::class);
    }
}
