@extends('layouts.app')

@section('content')
    {{-- FORM Obat --}}
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                @if ($action == 'input')
                    <h5 class="mb-0">Input Obat</h5>
                @elseif ($action == 'edit')
                    <h5 class="mb-0">Edit Obat</h5>
                @endif
            </div>
            <div class="card-body">
                @if ($action == 'input')
                    <form method="POST" action="{{ route('obat.post') }}">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Obat</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_obat" class="form-control" id="basic-default-name"
                                    placeholder="Nama Obat" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Kemasan</label>
                            <div class="col-sm-10">
                                <input type="text" name="kemasan" class="form-control" id="basic-default-name"
                                    placeholder="Kemasan" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Harga</label>
                            <div class="col-sm-10">
                                <input type="number" name="harga" class="form-control" id="basic-default-name"
                                    placeholder="Harga" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add Obat</button>
                            </div>
                        </div>
                    </form>
                @elseif ($action == 'edit')
                    <form method="POST" action="{{ route('obat.updateProses', $obats->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Obat</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_obat" class="form-control" id="basic-default-name"
                                    placeholder="Nama Obat" value="{{ $obats->nama_obat }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Kemasan</label>
                            <div class="col-sm-10">
                                <input type="text" name="kemasan" class="form-control" id="basic-default-name"
                                    placeholder="Kemasan" value="{{ $obats->kemasan }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" name="harga" class="form-control" id="basic-default-name"
                                    placeholder="Harga" value="{{ $obats->harga }}" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit Obat</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- LIST Obat --}}
    <div class="card">
        <h5 class="card-header">List Obat</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Obat</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($obat->count() > 0)
                        @foreach ($obat as $ob)
                            <tr>
                                <td>{{ $ob->nama_obat }}</td>
                                <td>{{ $ob->kemasan }}</td>
                                <td>{{ $ob->harga }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('obat.update', $ob->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <form action="{{ route('obat.delete', $ob->id) }}" method="POST">
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
                            <th colspan="5" class="text-center">No Obat</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
