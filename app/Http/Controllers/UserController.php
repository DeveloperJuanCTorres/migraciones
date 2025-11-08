<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(User::query())
                ->addColumn('action', function ($user) {

                    return '
                        <button class="btn btn-sm btn-info editar" data-id="' . $user->id . '">
                            <i class="fas fa-edit me-1"></i>Editar</button>

                        <button class="btn btn-sm btn-danger eliminar" data-id="' . $user->id . '"><i class="fas fa-trash me-1"></i>Eliminar</button>
                        
                    ';
                })
                ->rawColumns(['action']) // Necesario para renderizar HTML en la tabla
                ->make(true);
        }

        // Si no es AJAX, redirecciona (esto evita errores en acceso directo)
        return redirect()->route('users.index');
    }

    public function adduser(Request $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return response()->json(['status' => true, 'msg' => 'Usuario registrado']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }        
    }

    public function getUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name'  => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:6',
            ]);

            $user->name  = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return response()->json(['status' => true, 'msg' => 'Usuario actualizado']);

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'name'  => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . Auth::id(), // ignora el email actual del usuario
                'password' => 'nullable|string|min:6',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);
            /**
             * @var \App\Models\User $user
             */

            $user = Auth::user();
            $user->name  = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('image')) {
                // Elimina anterior si existe
                if ($user->image && Storage::disk('public')->exists('perfiles/' . $user->image)) {
                    Storage::disk('public')->delete('perfiles/' . $user->image);
                }

                $file = $request->file('image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('perfiles', $filename, 'public');
                $user->image = $filename;
            }

            $user->save();

            return response()->json(['status' => true, 'msg' => 'Usuario actualizado']);

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
        
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['status' => true, 'msg' => 'Usuario eliminado']);

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function perfil()
    {
        return view('users.perfil');
    }
}
