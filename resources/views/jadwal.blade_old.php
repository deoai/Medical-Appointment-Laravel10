@extends('layouts.app')

@section('content')
    {{-- FORM Jadwal --}}
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                @if ($action == 'input')
                    <h5 class="mb-0">Input Jadwal</h5>
                @elseif ($action == 'edit')
                    <h5 class="mb-0">Edit Jadwal</h5>
                @endif
            </div>
            <div class="card-body">
                @if ($jadwals->count() < 1 && $action == 'input')
                    <form method="POST" action="{{ route('jadwal.post') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="hari" id="hari">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jam_selesai" class="col-sm-2 col-form-label">Jam Selesai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai">
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add Poli</button>
                            </div>
                        </div>
                    </form>
                @elseif ($jadwals->count() > 0 && $action == 'edit')
                    @if ($active == false)
                        <form method="POST" action="{{ route('jadwal.updateProses', $jadwal->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="hari" id="hari">
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"
                                        value="{{ $jadwal->jam_mulai }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jam_selesai" class="col-sm-2 col-form-label">Jam Selesai</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai"
                                        value="{{ $jadwal->jam_selesai }}">
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Edit Poli</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <h5 class="mb-0 flex text-center">Tidak bisa Ubah Karena Hari Ini Jadwal Praktik </h5>
                    @endif
                @else
                    <h5 class="mb-0 flex text-center">Tidak bisa Input Jadwal Maksimal 1 dalam seminggu</h5>
                @endif

            </div>
        </div>
    </div>

    {{-- LIST Jadwal --}}
    <div class="card">
        <h5 class="card-header">List Jadwal Saya</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($jadwals->count() > 0)
                        @foreach ($jadwals as $jad)
                            <tr>
                                <td>{{ $jad->hari }}</td>
                                <td>{{ $jad->jam_mulai }}</td>
                                <td>{{ $jad->jam_selesai }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('jadwal.update', $jad->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <form action="{{ route('jadwal.delete', $jad->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit"><i
                                                        class="bx bx-trash me-1"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
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
