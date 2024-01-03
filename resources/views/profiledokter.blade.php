@extends('layouts.app')

@section('content')
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Profile</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profileDokter.update', $dokters->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="basic-default-name"
                                placeholder="John Doe" value="{{ $dokters->nama }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input name="email" type="text" id="basic-default-email" class="form-control"
                                    placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-default-email2"
                                    value="{{ $dokters->user->email }}" />
                                <span class="input-group-text" id="basic-default-email2">@example.com</span>
                            </div>
                            <div class="form-text">You can use letters, numbers & periods</div>
                        </div>
                    </div>
                    <div class="row mb-3">
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
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-phone">No Hp</label>
                        <div class="col-sm-10">
                            <input name="no_hp" type="text" id="basic-default-phone" class="form-control phone-mask"
                                placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone"
                                value="{{ $dokters->no_hp }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-message">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" id="basic-default-message" class="form-control" placeholder="Alamat"
                                aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2">{{ $dokters->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Email</label>
                        <div class="col-sm-10">
                            <input name="email" type="email" id="basic-default-phone" class="form-control phone-mask"
                                placeholder="Email" aria-label="658 799 8941" aria-describedby="basic-default-phone"
                                value="{{ $user->email }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Password Lama</label>
                        <div class="col-sm-10">
                            <input name="old_password" type="password" id="basic-default-phone"
                                class="form-control phone-mask" placeholder="Password Lama" aria-label="658 799 8941"
                                aria-describedby="basic-default-phone" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Password Baru</label>
                        <div class="col-sm-10">
                            <input name="new_password" type="password" id="basic-default-phone"
                                class="form-control phone-mask" placeholder="Password Lama" aria-label="658 799 8941"
                                aria-describedby="basic-default-phone" value="" />
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Edit Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
