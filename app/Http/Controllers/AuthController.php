<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        return view('login');
    }
    function loginPost(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email harus diisi',
                'password.required' => 'Password harus diisi'
            ]
        );

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($credentials)) {
            // simpan nama user yang login ke session
            // $request->session()->put('nama', Auth::user()->name);
            return redirect('/dashboard');
        } else {
            echo "Login gagal";
        }
    }
    function register()
    {
        return view('register');
    }
    function registerPost(Request $request)
    {
        //buat kan no rekam medis pasien dengan format yyyymm-xxx (tahun-bulan-urutan)
        $no_rekam_medis = date('Ym') . '-' . sprintf("%03d", Pasien::count() + 1);
        // dd($no_rekam_medis);
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'pasien',
            'password' => bcrypt($request->password),
        ]);
        Pasien::create([
            'no_rm' => $no_rekam_medis,
            'id_akun' => $users->id,
            'nama' => $request->name,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,

        ]);
        return redirect('/');
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
