<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios = User::all();
        return view('funcionario.listagem')->withFuncionarios($funcionarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dados = [
            'roles' => $roles = Role::all(),
        ];
        return view('funcionario.novo')->withDados($dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->genero = $request->genero;
        $user->telefone = $request->telefone;
        $user->password = Hash::make('12345678');
        $user->save();
        $user->saveRole($request->papel);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dados = [
            'funcionario' => User::find(decrypt($id)),
            'roles' => Role::all(),
        ];
        return view('funcionario.novo')->withDados($dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(decrypt($request->id));
        $request->validate([
            'nome' => 'required',
            'email' => 'email|required',
            'telefone' => 'required|regex:/^[9]{1}[1-9]{1}[0-9]{7}$/i',
            'papel' => ['required',
                function ($attribute, $value, $fail) use ($request, $user) {
                    if ($user->isGrouped(decrypt($request->id), $request->papel)) {
                        $fail('Este utilizador já pertence a este grupo');
                    }
                },
            ],
        ]);
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->genero = $request->genero;
        $user->telefone = $request->telefone;
        $user->save();
        $user->saveRole($request->papel);
        return redirect()->action('UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy(decrypt($id));
        return back();
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'nova_password' => 'required|min:8|confirmed',
        ]);
        $user = User::find(Auth::user()->id);
        if (Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->nova_password);
            $user->remember_token = Hash::make('issenguel');
            $user->save();
            return redirect('home');
        }

        return back();
    }
}
