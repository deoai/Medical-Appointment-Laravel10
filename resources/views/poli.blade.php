@extends('layouts.app')

@section('content')
    {{-- FORM DOKTER --}}
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                @if ($action == 'input')
                    <h5 class="mb-0">Input Poli</h5>
                @elseif ($action == 'edit')
                    <h5 class="mb-0">Edit Poli</h5>
                @endif
            </div>
            <div class="card-body">
                @if ($action == 'input')
                    <form method="POST" action="{{ route('poli.post') }}">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Poli</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_poli" class="form-control" id="basic-default-name"
                                    placeholder="John Doe" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" name="keterangan" class="form-control" id="basic-default-name"
                                    placeholder="John Doe" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add Poli</button>
                            </div>
                        </div>
                    </form>
                @elseif ($action == 'edit')
                    <form method="POST" action="{{ route('poli.updateProses', $polis->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Poli</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_poli" class="form-control" id="basic-default-name"
                                    placeholder="John Doe" value="{{ $polis->nama_poli }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" name="keterangan" class="form-control" id="basic-default-name"
                                    placeholder="John Doe" value="{{ $polis->keterangan }}" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit Poli</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- LIST Pasien --}}
    <div class="card">
        <h5 class="card-header">List Poli</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Poli</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($poli->count() > 0)
                        @foreach ($poli as $pol)
                            <tr>
                                <td>{{ $pol->nama_poli }}</td>
                                <td>{{ $pol->keterangan }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('poli.update', $pol->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <form action="{{ route('poli.delete', $pol->id) }}" method="POST">
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
