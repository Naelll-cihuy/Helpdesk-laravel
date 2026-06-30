@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">
        Dashboard Admin
    </h2>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card text-bg-primary">
                <div class="card-body text-center">
                    <h6>Total Device</h6>
                    <h2>{{ $totalDevice }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-bg-success">
                <div class="card-body text-center">
                    <h6>Total Ruangan</h6>
                    <h2>{{ $totalRoom }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-bg-warning">
                <div class="card-body text-center">
                    <h6>Total Kategori</h6>
                    <h2>{{ $totalCategory }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-bg-dark">
                <div class="card-body text-center">
                    <h6>Total Laporan</h6>
                    <h2>{{ $totalComplaint }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <h6>Pending</h6>
                    <h3>{{ $pending }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h6>Diproses</h6>
                    <h3>{{ $diproses }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-success">
                <div class="card-body text-center">
                    <h6>Selesai</h6>
                    <h3>{{ $selesai }}</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6>Total User</h6>
                    <h2>{{ $totalUser }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6>Admin</h6>
                    <h2>{{ $totalAdmin }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6>Teknisi</h6>
                    <h2>{{ $totalTeknisi }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card mb-4">

        <div class="card-header fw-bold">
            Menu Cepat
        </div>

        <div class="card-body">

            <a href="{{ route('devices.create') }}" class="btn btn-primary">
                Tambah Device
            </a>

            <a href="{{ route('rooms.create') }}" class="btn btn-success">
                Tambah Ruangan
            </a>

            <a href="{{ route('categories.create') }}" class="btn btn-warning">
                Tambah Kategori
            </a>

            <a href="{{ route('complaints.index') }}" class="btn btn-dark">
                Data Laporan
            </a>

        </div>

    </div>

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <strong>5 Laporan Terbaru</strong>

            <a href="{{ route('complaints.index') }}" class="btn btn-sm btn-outline-primary">
                Lihat Semua
            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th>Kode Laporan</th>
                        <th>Ruangan</th>
                        <th>Perangkat</th>
                        <th>Pelapor</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($complaints as $item)

                    <tr>

                        <td>
                            <code>{{ $item->kode_laporan }}</code>
                        </td>

                        <td>
                            <strong>{{ $item->device->room->kode_ruangan }}</strong>
                            <br>
                            <small class="text-muted">
                                {{ $item->device->room->nama_ruangan }}
                            </small>
                        </td>

                        <td>
                            {{ $item->device->nama_perangkat }}
                        </td>

                        <td>
                            {{ $item->user->name }}
                        </td>

                        <td>

                            @switch($item->status)

                                @case('Pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                    @break

                                @case('Diproses')
                                    <span class="badge bg-primary">Diproses</span>
                                    @break

                                @case('Remote')
                                    <span class="badge bg-info">Remote</span>
                                    @break

                                @case('Kunjungan Lokasi')
                                    <span class="badge bg-secondary">Kunjungan</span>
                                    @break

                                @case('Menunggu Sparepart')
                                    <span class="badge bg-dark">Sparepart</span>
                                    @break

                                @case('Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                    @break

                                @default
                                    <span class="badge bg-light text-dark">
                                        {{ $item->status }}
                                    </span>

                            @endswitch

                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal_lapor)->format('d-m-Y') }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">
                            Belum ada laporan.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection