<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;


class AuthController extends Controller
{
    // Fitur Login
    public function login()
    {
        return view('auth.login', ['navbar' => 'navbarLogin', 'footer' => 'footer']);
    }

    // Fitur Register
    public function register()
    {
        return view('auth.register', ['navbar' => '0', 'footer' => '0']);
    }

    // Menyimpan Data User
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_wa' => 'required|string|min:0|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }
        
        DB::beginTransaction();

        try {
            if ($request->email == 'adminjuki5@gmail.com' && $request->password == 'adminJuki@2024') {
                $role = 'superadmin';
            } else {
                $role = 'user';
            }

            // Create/Menyimpan Data User
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_wa' => $request->no_wa,
            ]);

            $user->assignRole($role);

            DB::commit();

            Auth::login($user);
            return redirect()->route('login')->with('success', 'Register success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('register')->with('error', 'Register failed. ' . $e->getMessage());
        }
    }

    // Autentikasi User
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('juki.index')->with('success', 'Login success');
        } else {
            return redirect()->route('login')->with('error', 'Login failed email or password is incorrect');
        }
    }

    public function page()
    {
        $user = Auth::user();

        return view('juki.index', compact('user'));
    }

    // Fitur Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}