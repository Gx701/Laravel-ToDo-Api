<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    //
    //
    /**
     * Login With auth.
     */
    public function login(Request $request)
    {
        //
        $loginData = $request->validate([
            'email'=>'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData))
        {
            return response(['message' => 'Invalid Credentials']);
        }

        $accesToken = auth()->user()->createToken('authToken')->accessToken;

        return response()->json(['user' => auth()->user(),
        'access_token' => $accesToken]);
    }
    //
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = new User();
        $user->name = 'John Doe';
        $user->email = 'john@example.com';
        $user->password = bcrypt('password');
        $user->save();

        return response()->json(['message' => 'User created successfully']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        //
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validateData['password'] = bcrypt($request->password);

        $user = User::create($validateData);

        $accesToken = $user->createToken('authToken')->accessToken;

        return response()->json(['user' => $user,
    'access_token' => $accesToken], 201); // Devuelve la tarea creada con el código de estado 201 (creado)
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // encriptacion de contraseña
        $user->updated_at = now(); // Actualiza la fecha de actualización

        $user->save();

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204); // Devuelve una respuesta vacía con el código de estado 204 (sin contenido) para indicar que se ha eliminado correctamente
    }
}
