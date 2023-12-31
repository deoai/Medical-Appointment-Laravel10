@extends('layouts.app')

@section('content')
    {{-- FORM Periksa --}}
    @if ($action == 'periksa')
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Periksa Pasien</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('periksaPasien.post', $id) }}">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">No Rekam Medis</label>
                            <div class="col-sm-10">
                                <input hidden type="text" name="no_rm" class="form-control" id="basic-default-name"
                                    placeholder="John Doe" value="{{ $pasien->no_rm }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">No Antrian</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="no_antrian" class="form-control"
                                    id="basic-default-name" placeholder="John Doe" value="{{ $no_antrian }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="nama" class="form-control" id="basic-default-name"
                                    placeholder="John Doe" value="{{ $pasien->nama }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Periksa</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="nama" class="form-control" id="basic-default-name"
                                    placeholder="John Doe" value="{{ $tgl }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Keluhan</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="keluhan" class="form-control" id="basic-default-name"
                                    placeholder="Keluhan" value="{{ $ket_antrian->keluhan }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Biaya Periksa</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="keluhan" class="form-control" id="basic-default-name"
                                    placeholder="Keluhan" value="Rp 150.000" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Pilih Obat</label>
                            <div class="col-sm-10">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="obatDropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Obat
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="obatDropdown">
                                        @foreach ($obat as $obats)
                                            <li>
                                                {{-- <input class="form-check-input form-check-input-lg" type="checkbox"
                                                    style="margin-right: 10px;" name="obat[]" value="{{ $obats->id }}"
                                                    id="obat{{ $obats->id }}"> --}}
                                                <input class="form-check-input form-check-input-lg" type="checkbox"
                                                    style="margin-right: 10px; width: 25px; height: 25px;" name="obat[]"
                                                    value="{{ $obats->id }}" id="obat{{ $obats->id }}">
                                                <input hidden type="text" name="harga[]" value="{{ $obats->harga }}">
                                                <label class="form-check-label" for="obat{{ $obats->id }}">
                                                    {{ ucwords(strtolower($obats->nama_obat)) }} - Rp.
                                                    {{ number_format($obats->harga, 0, ',', '.') }}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Catatan</label>
                            <div class="col-sm-10">
                                <textarea name="catatan" id="basic-default-message" class="form-control" placeholder="Catatan" aria-label="Catatan"
                                    aria-describedby="basic-icon-default-message2"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Periksa Pasien</button>
                            </div>
                        </div>
                        <div class="row mb-3" id="totalBiaya">
                            <label>Total Biaya</label>
                            <span>Rp 150.000</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
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
                        @if ($cekDaftarPoli->count() > 0)
                            @foreach ($cekDaftarPoli as $jad)
                                <tr>
                                    <td>{{ $jad->no_antrian }}</td>
                                    <td>{{ $jad->nama }}</td>
                                    <td>{{ $jad->keluhan }}</td>
                                    <td>
                                        {{-- jika $jad->id ada di $hasilperiksa->id_daftar_poli --}}
                                        @foreach ($hasilPeriksa as $hasil)
                                            @if ($jad->id == $hasil->id_daftar_poli)
                                                <a hidden>
                                                    {{ $i = 1 }}
                                                </a>
                                            @break

                                        @else
                                            <a hidden>
                                                {{ $i = 0 }}
                                            </a>
                                        @endif
                                    @endforeach
                                    @if ($i == 0)
                                        <a href="{{ route('periksaPasien', [$jad->id, $jad->no_antrian]) }}"
                                            class="btn btn-primary">Periksa</a>
                                    @else
                                        <div>

                                            <div>
                                                Sudah Diperiksa
                                            </div>
                                        </div>
                                    @endif
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
@endif

{{-- LIST Pasien --}}

<br>
<br>
{{-- LIST Riwayat Pasien --}}
<div class="card">
    <h5 class="card-header">Daftar Riwayat Pasien</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No Rekam Medis</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Periksa</th>
                    <th>Keluhan</th>
                    <th>Obat</th>
                    <th>totalBiaya</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if ($periksa->count() > 0)
                    @foreach ($periksa as $riw)
                        <tr>
                            <td>{{ $riw->no_rm }}</td>
                            <td>{{ $riw->nama }}</td>
                            <td>{{ $riw->tgl_periksa }}</td>
                            <td>{{ $riw->keluhan }}</td>

                            <td>
                                @foreach ($detailPeriksa as $obat)
                                    @if ($obat->id_periksa == $riw->id)
                                        {{ $obat->nama_obat }} <br>
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ 'Rp ' . number_format($riw->biaya_periksa, 0, ',', '.') }}</td>
                            <td>{{ $riw->catatan }}</td>

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


<script>
    const obat = document.querySelectorAll('input[name="obat[]"]');
    const harga = document.querySelectorAll('input[name="harga[]"]');
    const totalBiaya = document.querySelector('#totalBiaya span');
    let total = 150000;
    obat.forEach((obat, index) => {
        obat.addEventListener('change', () => {
            if (obat.checked) {
                total += parseInt(harga[index].value);
            } else {
                total -= parseInt(harga[index].value);
            }
            totalBiaya.innerHTML = formatIDR(total);
        })
    })

    function formatIDR(amount) {
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        const formattedAmount = formatter.format(amount);
        return formattedAmount.slice(0, -3);
    }
</script>
@endsection
