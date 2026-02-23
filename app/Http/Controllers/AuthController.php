<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where('name', $request->name)
            ->where('role', $request->role)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user]);

            if ($user->role === 'sales') {
                return redirect('/sales');
            } elseif ($user->role === 'admin') {
                return redirect('/admin');
            } elseif ($user->role === 'gudang') {
                return redirect('/gudang');
            }
        }

        return back()->with('error', 'Login gagal');
    }
}
