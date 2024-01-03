<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // VIEW DOKTER AS ADMIN
    public function dokter()
    {
        $dokter = Dokter::with(['user', 'poli'])->get();
        $poli = Poli::all();
        $action = 'input';
        return view('dokter', compact('dokter', 'poli', 'action'));
        // dd($action);
    }

    // CREATE DOKTER AS ADMIN
    public function dokterPost(Request $request)
    {
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'dokter',
            'password' => bcrypt($request->password),
        ]);
        Dokter::create([
            'id_akun' => $users->id,
            'id_poli' => $request->id_poli,
            'nama' => $users->name,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);
        return redirect('/admin/dokter');
    }

    // UPDATE VIEW DOKTER AS ADMIN
    public function dokterUpdate(Request $request, $id)
    {
        $dokter = Dokter::with(['user', 'poli'])->get();
        $dokters = Dokter::where('id', $id)->first();
        $poli = Poli::all();
        $action = 'edit';
        return view('dokter', compact('dokter', 'dokters', 'poli', 'action', 'id'));
    }
    // UPDATE  DOKTER AS ADMIN
    public function dokterUpdateProses(Request $request, $id)
    {
        $dokter = Dokter::where('id', $id)->first();
        if (Hash::check($request->old_password, $dokter->user->password)) {
            $dokter->update([
                'id_poli' => $request->id_poli,
                'nama' => $request->name,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]);
            $users = User::where('id', $dokter->id_akun)->first();
            $users->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->new_password),
            ]);
            return redirect('admin/dokter');
        } else {
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
        }
    }

    // DELETE DOKTER AS ADMIN
    public function dokterDelete($id)
    {
        $dokter = Dokter::where('id', $id);
        $users = User::where('id', $dokter->first()->id_akun);
        // $cek = $dokter->first();
        $dokter->delete();
        $users->delete();
        return redirect('admin/dokter');
    }

    // VIEW PASIEN AS ADMIN
    public function pasien()
    {
        $pasien = Pasien::with(['user'])->get();
        $action = 'input';
        return view('pasien', compact('pasien', 'action'));
    }

    // CREATE PASIEN AS ADMIN
    public function pasienPost(Request $request)
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
        return redirect('/admin/pasien');
    }

    // UPDATE VIEW PASIEN AS ADMIN
    public function pasienUpdate(Request $request, $id)
    {
        $pasien = Pasien::with(['user'])->get();
        $pasiens = Pasien::where('id', $id)->first();
        $action = 'edit';
        return view('pasien', compact('pasien', 'pasiens', 'action', 'id'));
    }

    // UPDATE PASIEN AS ADMIN
    public function pasienUpdateProses(Request $request, $id)
    {
        $pasien = Pasien::where('id', $id)->first();
        $pasien->update([
            'nama' => $request->name,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
        ]);
        $users = User::where('id', $pasien->id_akun)->first();
        $users->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect('admin/pasien');
    }

    // DELETE PASIEN AS ADMIN
    public function pasienDelete($id)
    {
        $pasien = Pasien::where('id', $id);
        $users = User::where('id', $pasien->first()->id_akun);
        $pasien->delete();
        $users->delete();
        return redirect('admin/pasien');
    }


    // VIEW POLI AS ADMIN
    function poli()
    {
        $poli = Poli::all();
        $action = 'input';
        return view('poli', compact('poli', 'action'));
    }

    // CREATE POLI AS ADMIN
    function poliPost(Request $request)
    {
        Poli::create([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/admin/poli');
    }

    // UPDATE VIEW POLI AS ADMIN
    function poliUpdate(Request $request, $id)
    {
        $poli = Poli::all();
        $polis = Poli::where('id', $id)->first();
        $action = 'edit';
        return view('poli', compact('poli', 'polis', 'action', 'id'));
    }

    // UPDATE POLI AS ADMIN
    function poliUpdateProses(Request $request, $id)
    {
        $poli = Poli::where('id', $id)->first();
        $poli->update([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('admin/poli');
    }

    // DELETE POLI AS ADMIN
    function poliDelete($id)
    {
        $poli = Poli::where('id', $id);
        $poli->delete();
        return redirect('admin/poli');
    }

    // VIEW OBAT AS ADMIN
    function obat()
    {
        $obat = Obat::all();
        $action = 'input';
        return view('obat', compact('obat', 'action'));
    }

    // CREATE OBAT AS ADMIN
    function obatPost(Request $request)
    {
        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);
        return redirect('/admin/obat');
    }

    // UPDATE VIEW OBAT AS ADMIN
    function obatUpdate(Request $request, $id)
    {
        $obat = Obat::all();
        $obats = Obat::where('id', $id)->first();
        $action = 'edit';
        return view('obat', compact('obat', 'obats', 'action', 'id'));
    }

    // UPDATE OBAT AS ADMIN
    function obatUpdateProses(Request $request, $id)
    {
        $obat = Obat::where('id', $id)->first();
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);
        return redirect('admin/obat');
    }

    // DELETE OBAT AS ADMIN
    function obatDelete($id)
    {
        $obat = Obat::where('id', $id);
        $obat->delete();
        return redirect('admin/obat');
    }
}
