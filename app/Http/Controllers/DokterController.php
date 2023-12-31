<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    function jadwal()
    {
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        $jadwals = Jadwal::where('id_dokter', $dokter->id)->get();
        $action = 'input';
        $active = false;
        //dd to array
        // dd($jadwals->toArray());


        // dd($active);

        return view('jadwal', compact('jadwals', 'action', 'active'));
    }
    function jadwalPost(Request $request)
    {
        // dd($request->all());
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        Jadwal::create([
            'id_dokter' => $dokter->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);
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
        $jadwal = Jadwal::where('id', $id)->first();
        $jadwal->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);
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
        return view('periksa');
    }
}
