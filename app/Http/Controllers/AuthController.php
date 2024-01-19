<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    public function login() {
        return view('auth.login');
    }

    public function register() {
        $class = Kelas::all();
        return view('auth.register', [
            'classes' => $class,
        ]);
    }

    public function handleLogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        return redirect()->back()->with('error', 'Kombinasi Email dan Password salah!');
    }

    public function handleApiLogin(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->accessToken;

            return response()->json([
                'user' => $user,
                'access_token' => $token,
            ]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function handleRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'role' => ['required', 'in:admin,petugas'],
            'name' => ['required', 'string'],
            'nis' => ['nullable', 'numeric'],
            'telephone' => ['nullable', 'numeric'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
            'class' => ['required', 'in:XII-RPL, XI-PPGL1, XI-PPLG2, X-PPLG1, X-PPLG2, XII-MM, XI-DKV1, XI-DKV2, X-DKV1, X-DKV2, XII-PFTV, XI-BCF1, XI-BCF2, X-BCF1, X-BCF2'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if ($user !== null) {
            return redirect()->back()->with('error', 'Email sudah digunakan!');
        }

        $newUser = new User;
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->role = $request->role;
        $newUser->nis = $request->nis;
        $newUser->telephone = $request->telephone;
        $newUser->class = $request->class;
        $newUser->save();

        return redirect()->intended('login')->with('success', 'Akun anda berhasil dibuat, silahkan login.');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

}
