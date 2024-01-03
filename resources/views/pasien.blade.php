@extends('layouts.app')

@section('content')
    {{-- FORM DOKTER --}}
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                @if ($action == 'input')
                    <h5 class="mb-0">Input Pasien</h5>
                @elseif ($action == 'edit')
                    <h5 class="mb-0">Edit Pasien</h5>
                @endif
            </div>
            <div class="card-body">
                @if ($action == 'input')
                    <form method="POST" action="{{ route('pasien.post') }}">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="basic-default-name"
                                    placeholder="Nama" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input name="email" type="text" id="basic-default-email" class="form-control"
                                        placeholder="Email" aria-label="john.doe" aria-describedby="basic-default-email2" />
                                    <span class="input-group-text" id="basic-default-email2">@example.com</span>
                                </div>
                                <div class="form-text">You can use letters, numbers & periods</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-password">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" id="basic-default-password"
                                    placeholder="*****" />
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Poli</label>
                            <div class="col-sm-10">
                                <select name="id_poli" class="form-control" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    <option selected>Pilih Poli</option>
                                    @foreach ($poli as $polis)
                                        <option value="{{ $polis->id }}">
                                            {{ ucwords(strtolower($polis->nama_poli)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">No KTP</label>
                            <div class="col-sm-10">
                                <input name="no_ktp" type="text" id="basic-default-phone"
                                    class="form-control phone-mask" placeholder="No KTP" aria-label="658 799 8941"
                                    aria-describedby="basic-default-phone" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">No Hp</label>
                            <div class="col-sm-10">
                                <input name="no_hp" type="text" id="basic-default-phone"
                                    class="form-control phone-mask" placeholder="No Hp" aria-label="658 799 8941"
                                    aria-describedby="basic-default-phone" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" id="basic-default-message" class="form-control" placeholder="Alamat"
                                    aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add Pasien</button>
                            </div>
                        </div>
                    </form>
                @elseif ($action == 'edit')
                    <form method="POST" action="{{ route('pasien.updateProses', $pasiens->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="basic-default-name"
                                    placeholder="John Doe" value="{{ $pasiens->nama }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input name="email" type="text" id="basic-default-email" class="form-control"
                                        placeholder="john.doe" aria-label="john.doe"
                                        aria-describedby="basic-default-email2" value="{{ $pasiens->user->email }}" />
                                    <span class="input-group-text" id="basic-default-email2">@example.com</span>
                                </div>
                                <div class="form-text">You can use letters, numbers & periods</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">No KTP</label>
                            <div class="col-sm-10">
                                <input name="no_ktp" type="text" id="basic-default-phone"
                                    class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941"
                                    aria-describedby="basic-default-phone" value="{{ $pasiens->no_ktp }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">No Hp</label>
                            <div class="col-sm-10">
                                <input name="no_hp" type="text" id="basic-default-phone"
                                    class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941"
                                    aria-describedby="basic-default-phone" value="{{ $pasiens->no_hp }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" id="basic-default-message" class="form-control" placeholder="Alamat"
                                    aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2">{{ $pasiens->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit Pasien</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- LIST Pasien --}}
    <div class="card">
        <h5 class="card-header">List Pasien</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No RM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No KTP</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($pasien->count() > 0)
                        @foreach ($pasien as $pas)
                            <tr>
                                <td>{{ $pas->no_rm }}</td>
                                <td>{{ $pas->nama }}</td>
                                <td>{{ $pas->user->email }}</td>
                                <td>{{ $pas->no_ktp }}</td>
                                <td>{{ $pas->no_hp }}</td>
                                <td>{{ $pas->alamat }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('pasien.update', $pas->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <form action="{{ route('pasien.delete', $pas->id) }}" method="POST">
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
                            <th colspan="5" class="text-center">No Dokter</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
