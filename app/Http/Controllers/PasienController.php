<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    function poli()
    {
        $pasien = Pasien::where('id_akun', Auth::user()->id)->first();
        $poli = Poli::all();
        $jadwals = Jadwal::with(['dokter', 'poli'])->get();
        $cekPendaftaran = DaftarPoli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->where('daftar_poli.id_pasien', $pasien->id)
            ->select('daftar_poli.*', 'jadwal_periksa.*', 'poli.*', 'dokter.*')
            ->get();

        // dd($cekPendaftaran->toArray());
        return view('daftarpoli', compact('cekPendaftaran', 'pasien', 'poli', 'jadwals'));
    }
    function poliPost(Request $request)
    {
        $pasien = Pasien::where('id_akun', Auth::user()->id)->first();
        DaftarPoli::create([
            'id_pasien' => $pasien->id,
            'id_jadwal' => $request->jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $this->generateNoAntrian($request->jadwal),
        ]);
        // dd($test);
        return redirect('/pasien/poli');
    }
    protected function generateNoAntrian($jadwal)
    {
        $daftar_poli = DaftarPoli::where('id_jadwal', $jadwal)->get();
        $no_antrian = count($daftar_poli) + 1;
        return $no_antrian;
    }
}
