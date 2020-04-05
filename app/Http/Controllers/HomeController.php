<?php

namespace App\Http\Controllers;

use App\Venda;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->isFirstTime()) {
            return view('auth.password_verify');
        }
        $qtdEstorno = Venda::where('estado', 'por_estornar')->count();
        session(['qtd_estorno' => $qtdEstorno]);
        return view('home');
    }
}
