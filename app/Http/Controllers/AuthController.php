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
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = User::where('name', $request->name)
            ->where('role', $request->role)
            ->first();

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan atau role salah.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah.');
        }

        session(['user' => $user]);

        if ($user->role === 'sales') {
            return redirect('/sales');
        } elseif ($user->role === 'admin') {
            return redirect('/admin');
        } else {
            return redirect('/gudang');
        }
    }
}
