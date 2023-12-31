@extends('layouts.app')

@section('content')
    {{-- FORM DOKTER --}}
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Daftar Poli</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('daftarpoli.post') }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">No Rekam Medis</label>
                        <div class="col-sm-10">
                            <input disabled type="text" name="nama_poli" class="form-control" id="basic-default-name"
                                placeholder="John Doe" value="{{ $pasien->no_rm }}" />
                        </div>
                    </div>

                    {{-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih Poli dan Dokter</label>
                        <div class="col-sm-10">
                            <select name="jadwal" id="jadwal"
                                class="block w-1/2 rounded-md border border-slate-300 bg-white px-3 py-4 font-semibold text-gray-500 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm">
                                <option class="font-semibold text-slate-300">Pilih Jadwal</option>
                                @foreach ($jadwals as $jadwal)
                                    <option value="{{ $jadwal['id'] }}">{{ ucwords($jadwal->dokter->nama) }} -
                                        {{ $jadwal->dokter->poli->nama_poli }} -
                                        {{ $jadwal->hari }} - {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Poli</label>
                        <div class="col-sm-10">
                            <select name="id_poli" class="form-control" id="exampleFormControlSelect1"
                                aria-label="Default select example">
                                <option selected>Pilih Poli</option>
                                @foreach ($poli as $polis)
                                    <option value="{{ $polis->id }}"
                                        {{ $polis->id == $dokters->id_poli ? 'selected' : '' }}>
                                        {{ ucwords(strtolower($polis->nama_poli)) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih Dokter dan Jadwal</label>
                        <div class="col-sm-10">
                            <select name="jadwal" class="form-control" id="exampleFormControlSelect1"
                                aria-label="Default select example">
                                <option selected>Pilih Dokter dan Jadwal</option>
                                @foreach ($jadwals as $jadwal)
                                    <option value="{{ $jadwal['id'] }}">
                                        {{ ucwords($jadwal->dokter->nama) }} -
                                        {{ $jadwal->dokter->poli->nama_poli }} -
                                        {{ $jadwal->hari }} - {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Keluhan</label>
                        <div class="col-sm-10">
                            <input type="text" name="keluhan" class="form-control" id="basic-default-name"
                                placeholder="Keluhan" />
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Add Poli</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- LIST daftar --}}
    <div class="card">
        <h5 class="card-header">List Daftar Poli</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Poli</th>
                        <th>Dokter</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>No Antrian</th>
                        <th>Keluhan</th>
                        {{-- <th>Action</th> --}}

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($cekPendaftaran->count() > 0)
                        @foreach ($cekPendaftaran as $pol)
                            <tr>
                                <td>{{ $pol->nama_poli }}</td>
                                <td>{{ $pol->nama }}</td>
                                <td>{{ $pol->hari }}</td>
                                <td>{{ $pol->jam_mulai }}</td>
                                <td>{{ $pol->jam_selesai }}</td>
                                <td>{{ $pol->no_antrian }}</td>
                                <td>{{ $pol->keluhan }}</td>
                                {{-- <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('daftarpoli.update', $pol->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <form action="{{ route('daftarpoli.delete', $pol->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit"><i
                                                        class="bx bx-trash me-1"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th colspan="5" class="text-center">No Poli</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
