<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

    public function fornecedores()
    {
        return $this->hasMany(Fornecedor::class);
    }

    public function saveRole($role_id)
    {
        DB::table('role_user')->insert([
            'role_id' => $role_id,
            'user_id' => $this->id,
        ]);
    }

    public function isGrouped($user_id, $role_id)
    {
        $retorno = DB::table('role_user')
            ->where([
                ['user_id', '=', $user_id],
                ['role_id', '=', $role_id],
            ])
            ->get();
        if (count($retorno) > 0) {
            return true;
        }

        return false;
    }

    public function isFirstTime()
    {
        $dados = DB::table('users')->select('*')
            ->where('id', $this->id)->get();
        return ($dados[0]->remember_token == null);
    }
}
