<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Periksa;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    function jadwal()
    {
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        $jadwals = Jadwal::where('id_dokter', $dokter->id)->get();
        $action = 'input';
        $active = false;

        return view('jadwal', compact('jadwals', 'action', 'active'));
    }
    function jadwalPost(Request $request)
    {
        // dd($request->all());
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        // dd($request->all());
        Jadwal::create([
            'id_dokter' => $dokter->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);
        if ($request->status == 'y') {
            $jadwals = Jadwal::where('id_dokter', $dokter->id)->get();
            foreach ($jadwals as $key => $value) {
                $value->update([
                    'status' => 'n',
                ]);
            }
            $jadwal = Jadwal::where('id', Jadwal::orderBy('id', 'desc')->first()->id)->first();
            $jadwal->update([
                'status' => 'y',
            ]);
        }
        return redirect('/dokter/jadwal');
    }
    function jadwalUpdate(Request $request, $id)
    {
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        $jadwals = Jadwal::where('id_dokter', $dokter->id)->get();
        $cjadwals = Jadwal::where('id_dokter', $dokter->id)->get();

        $today = today()->format('l');
        $today = strtolower($today);
        $active = false;
        //define hari ke inggris
        $hari = [
            'Senin' => 'monday',
            'Selasa' => 'tuesday',
            'Rabu' => 'wednesday',
            'Kamis' => 'thursday',
            'Jumat' => 'friday',
            'Sabtu' => 'saturday',
            'Minggu' => 'sunday',
        ];
        // ubah jadwals-> hari ke inggris dan jika harinya sama dengan hari ini maka variabel active = true
        foreach ($cjadwals as $key => $value) {
            $value->hari = $hari[$value->hari];
            if ($value->hari == $today) {
                $active = true;
            } else {
                $active = false;
            }
        }

        $jadwal = Jadwal::where('id', $id)->first();
        $action = 'edit';
        //dd to array
        // dd($jadwals->toArray());
        return view('jadwal', compact('jadwals', 'action', 'jadwal', 'id', 'active'));
    }
    function jadwalUpdateProses(Request $request, $id)
    {
        // dd($request->all());
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        $jadwal = Jadwal::where('id', $id)->first();
        $jadwal->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);
        if ($request->status == 'y') {
            $jadwals = Jadwal::where('id_dokter', $dokter->id)->get();
            foreach ($jadwals as $key => $value) {
                $value->update([
                    'status' => 'n',
                ]);
            }
            $jadwal = Jadwal::where('id', $id)->first();
            $jadwal->update([
                'status' => 'y',
            ]);
        }
        return redirect('/dokter/jadwal');
    }
    function jadwalDelete(Request $request, $id)
    {
        $jadwal = Jadwal::where('id', $id)->first();
        $jadwal->delete();
        return redirect('/dokter/jadwal');
    }

    function periksa()
    {
        $action = 'none';
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        $jadwals = Jadwal::where('id_dokter', $dokter->id)->get();
        $daftar_poli = DaftarPoli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->where('jadwal_periksa.id_dokter', $dokter->id)
            ->select('daftar_poli.*', 'jadwal_periksa.*', 'poli.*', 'dokter.*', 'pasien.*')
            ->get();
        $cekDaftarPoli = DaftarPoli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->where('jadwal_periksa.id_dokter', $dokter->id)
            ->select('jadwal_periksa.*', 'poli.*', 'dokter.*', 'pasien.*', 'daftar_poli.*')
            ->get();
        // dd($cekDaftarPoli->toArray());
        $i = 0;
        $hasilPeriksa = Periksa::all();
        $periksa = Periksa::join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            // ->join('detail_periksa', 'periksa.id', '=', 'detail_periksa.id_periksa')
            // ->join('obat', 'detail_periksa.id_obat', '=', 'obat.id')
            ->where('jadwal_periksa.id_dokter', $dokter->id)
            ->select('daftar_poli.*', 'pasien.id', 'pasien.nama', 'jadwal_periksa.*', 'dokter.*', 'poli.*', 'pasien.*', 'periksa.*')
            ->get();
        //ubah $riwayatPasien berdasarkan id_daftar_poli dan jadikan satu detail_periksa dan obat, jika id_daftar_poli sama

        $detailPeriksa = DetailPeriksa::join('periksa', 'detail_periksa.id_periksa', '=', 'periksa.id')
            ->join('obat', 'detail_periksa.id_obat', '=', 'obat.id')
            ->select('detail_periksa.*', 'obat.*')
            ->get();
        // dd($cekDaftarPoli->toArray());
        return view('periksa', compact('daftar_poli', 'action', 'periksa', 'detailPeriksa', 'cekDaftarPoli', 'hasilPeriksa', 'i'));
    }
    function periksaPasien(Request $request, $id, $no_antrian)
    {
        $hasilPeriksa = Periksa::all();
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        $cekDaftarPoli = DaftarPoli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->where('jadwal_periksa.id_dokter', $dokter->id)
            ->select('jadwal_periksa.*', 'poli.*', 'dokter.*', 'pasien.*', 'daftar_poli.*')
            ->get();
        $jadwals = Jadwal::where('id_dokter', $dokter->id)->get();
        $daftar_poli = DaftarPoli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->where('jadwal_periksa.id_dokter', $dokter->id)
            ->select('daftar_poli.*', 'jadwal_periksa.*', 'poli.*', 'dokter.*', 'pasien.*')
            ->get();
        $pasien = $daftar_poli->where('no_antrian', $no_antrian)->first();
        // dd($daftar_poli->toArray());
        // dd($jadwals->toArray());
        $action = 'periksa';
        $ket_antrian = DaftarPoli::where('id', $id)->where('id_jadwal', $jadwals->first()->id)->first();
        // dd($ket_antrian->toArray());
        // dd($pasien->toArray());
        // dd($no_antrian);

        date_default_timezone_set('Asia/Jakarta');
        $tgl = now()->format('Y-m-d H:i:s');

        //dari inputan obat dengan name=obat[] terpilih di form periksa tampung ke variabel $obats
        $obats = $request->obat;
        $obat = Obat::all();

        $periksa = Periksa::join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            // ->join('detail_periksa', 'periksa.id', '=', 'detail_periksa.id_periksa')
            // ->join('obat', 'detail_periksa.id_obat', '=', 'obat.id')
            ->where('jadwal_periksa.id_dokter', $dokter->id)
            ->select('daftar_poli.*', 'pasien.id', 'pasien.nama', 'jadwal_periksa.*', 'dokter.*', 'poli.*', 'pasien.*', 'periksa.*')
            ->get();
        //ubah $riwayatPasien berdasarkan id_daftar_poli dan jadikan satu detail_periksa dan obat, jika id_daftar_poli sama

        $detailPeriksa = DetailPeriksa::join('periksa', 'detail_periksa.id_periksa', '=', 'periksa.id')
            ->join('obat', 'detail_periksa.id_obat', '=', 'obat.id')
            ->select('detail_periksa.*', 'obat.*')
            ->get();

        return view('periksa', compact('daftar_poli', 'action', 'pasien', 'id', 'ket_antrian', 'no_antrian', 'tgl', 'obat', 'periksa', 'detailPeriksa', 'cekDaftarPoli', 'hasilPeriksa'));
    }

    function periksaPasienPost(Request $request, $id)
    {
        // dd($request->all());
        $action = 'none';
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        $jadwals = Jadwal::where('id_dokter', $dokter->id)->get();
        $daftar_poli = DaftarPoli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->where('jadwal_periksa.id_dokter', $dokter->id)
            ->select('daftar_poli.*', 'jadwal_periksa.*', 'poli.*', 'dokter.*', 'pasien.*')
            ->get();
        // dd($daftar_poli->toArray());
        // dd($jadwals->toArray());
        $action = 'periksa';
        $pasien = Pasien::where('id', $id)->first();
        //where id pasien = $id and id_jadwal = $jadwals->id
        $ket_antrian = DaftarPoli::where('id_pasien', $id)->where('id_jadwal', $jadwals->first()->id)->first();
        // dd($request->all());
        // dd($pasien->toArray());
        // dd($no_antrian);

        date_default_timezone_set('Asia/Jakarta');
        $tgl = now()->format('Y-m-d H:i:s');

        //dari inputan obat dengan name=obat[] terpilih di form periksa tampung ke variabel $obats
        $obats = $request->obat;
        $obat = Obat::whereIn('id', $obats)->get();
        $totalbiaya = 150000;
        foreach ($obat as $key => $value) {
            $totalbiaya += $value->harga;
        }
        // dd($request->toArray());
        //insert into 
        Periksa::create([
            'id_daftar_poli' => $id,
            'tgl_periksa' => $tgl,
            'catatan' => $request->catatan,
            'biaya_periksa' => $totalbiaya,
        ]);
        foreach ($obats as $key => $obat) {
            DetailPeriksa::create([
                'id_periksa' => Periksa::orderBy('id', 'desc')->first()->id,
                'id_obat' => $obat,
            ]);
        }
        return redirect('/dokter/periksa');
    }
    function profileDokter()
    {
        $dokter = Dokter::with(['user', 'poli'])->get();
        $dokters = Dokter::where('id_akun', Auth::user()->id)->first();
        $user = User::where('id', Auth::user()->id)->first();
        $poli = Poli::all();
        $action = 'edit';
        return view('profiledokter', compact('dokter', 'dokters', 'poli', 'action', 'user'));
    }
    function profileDokterUpdate(Request $request, $id)
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
            return redirect('/');
        } else {
            return back()->withErrors(['old_password' => 'Password lama tidak sesuai']);
        }
    }
}
