@extends('layouts.app')

@section('content')

    {{-- LIST Pasien --}}
    <div class="card">
        <h5 class="card-header">List Pasien Saya</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No Antrian</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
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
                            <th colspan="5" class="text-center">No Pasien</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
