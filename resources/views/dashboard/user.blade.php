@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">
        Dashboard User
    </h2>

    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card border-dark shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Laporan</h6>
                    <h2>{{ $total }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                    <h6>Pending</h6>
                    <h2>{{ $pending }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h6>Diproses</h6>
                    <h2>{{ $diproses }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <h6>Selesai</h6>
                    <h2>{{ $selesai }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <strong>Riwayat Laporan Saya</strong>

            <a href="{{ route('complaints.create') }}" class="btn btn-light btn-sm">
                + Buat Laporan
            </a>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">

                    <tr>

                        <th>Kode</th>
                        <th>Ruangan</th>
                        <th>Perangkat</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($complaints as $item)

                    <tr>

                        <td>
                            <strong>{{ $item->kode_laporan }}</strong>
                        </td>

                        <td>
                            {{ $item->device->room->kode_ruangan }}
                        </td>

                        <td>
                            {{ $item->device->nama_perangkat }}
                        </td>

                        <td>
                            {{ $item->judul }}
                        </td>

                        <td>

                            @switch($item->status)

                                @case('Pending')
                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>
                                @break

                                @case('Diproses')
                                    <span class="badge bg-primary">
                                        Diproses
                                    </span>
                                @break

                                @case('Remote')
                                    <span class="badge bg-info">
                                        Remote
                                    </span>
                                @break

                                @case('Kunjungan Lokasi')
                                    <span class="badge bg-secondary">
                                        Kunjungan
                                    </span>
                                @break

                                @case('Menunggu Sparepart')
                                    <span class="badge bg-dark">
                                        Sparepart
                                    </span>
                                @break

                                @case('Selesai')
                                    <span class="badge bg-success">
                                        Selesai
                                    </span>
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

</div>

@endsection