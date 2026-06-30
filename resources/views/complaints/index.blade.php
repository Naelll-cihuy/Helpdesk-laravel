@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Data Laporan
            </h5>

            @role('user')
                <a href="{{ route('complaints.create') }}" class="btn btn-light btn-sm">
                    + Buat Laporan
                </a>
            @endrole

        </div>

        <div class="card-body">

            <form method="GET" action="{{ route('complaints.index') }}">

<div class="row mb-3">

<div class="col-md-2">
    <input
        type="date"
        name="tanggal_awal"
        class="form-control"
        value="{{ request('tanggal_awal') }}"
    >
</div>

<div class="col-md-2">
    <input
        type="date"
        name="tanggal_akhir"
        class="form-control"
        value="{{ request('tanggal_akhir') }}"
    >
</div>

<div class="col-md-5">

<input
type="text"
name="search"
class="form-control"
placeholder="Cari kode, judul, pelapor, perangkat..."
value="{{ request('search') }}"
>

</div>

<div class="col-md-3">

<select
name="status"
class="form-select"
>

<option value="">Semua Status</option>

<option value="Pending"
{{ request('status')=='Pending'?'selected':'' }}>
Pending
</option>

<option value="Diproses"
{{ request('status')=='Diproses'?'selected':'' }}>
Diproses
</option>

<option value="Remote"
{{ request('status')=='Remote'?'selected':'' }}>
Remote
</option>

<option value="Kunjungan Lokasi"
{{ request('status')=='Kunjungan Lokasi'?'selected':'' }}>
Kunjungan
</option>

<option value="Menunggu Sparepart"
{{ request('status')=='Menunggu Sparepart'?'selected':'' }}>
Menunggu Sparepart
</option>

<option value="Selesai"
{{ request('status')=='Selesai'?'selected':'' }}>
Selesai
</option>

</select>

</div>

<div class="col-md-4">

<button class="btn btn-primary">

Cari

</button>

<a
href="{{ route('complaints.index') }}"
class="btn btn-secondary"
>

Reset

</a>

</div>

</div>

</form>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark text-center">

                    <tr>

                        <th width="50">No</th>
                        <th width="140">Kode</th>
                        <th width="90">Foto</th>
                        <th width="130">Ruangan</th>
                        <th width="220">Perangkat</th>
                        <th width="160">Pelapor</th>
                        <th>Judul</th>
                        <th width="120">Status</th>
                        <th width="120">Tanggal</th>
                        <th width="150">Aksi</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($complaints as $complaint)

                        <tr>

                            <td class="text-center">

                                {{ $loop->iteration + ($complaints->currentPage()-1) * $complaints->perPage() }}

                            </td>

                            <td>

                                <strong>{{ $complaint->kode_laporan }}</strong>

                            </td>

                            <td class="text-center">

                                @if($complaint->foto)

                                    <a href="{{ asset('storage/'.$complaint->foto) }}" target="_blank">

                                        <img
                                            src="{{ asset('storage/'.$complaint->foto) }}"
                                            class="img-thumbnail"
                                            style="width:70px;height:70px;object-fit:cover;"
                                        >

                                    </a>

                                @else

                                    <span class="text-muted">-</span>

                                @endif

                            </td>

                            <td>

                                <strong>

                                    {{ $complaint->device->room->kode_ruangan }}

                                </strong>

                                <br>

                                <small class="text-muted">

                                    {{ $complaint->device->room->nama_ruangan }}

                                </small>

                            </td>

                            <td>

                                <strong>

                                    {{ $complaint->device->nama_perangkat }}

                                </strong>

                                <br>

                                <small class="text-muted">

                                    {{ $complaint->device->kode_perangkat }}

                                </small>

                            </td>

                            <td>

                                {{ $complaint->user->name ?? '-' }}

                            </td>

                            <td>

                                {{ $complaint->judul }}

                            </td>

                            <td class="text-center">

                                @switch($complaint->status)

                                    @case('Pending')
                                        <span class="badge bg-warning text-dark px-3">
                                            Pending
                                        </span>
                                    @break

                                    @case('Diproses')
                                        <span class="badge bg-primary px-3">
                                            Diproses
                                        </span>
                                    @break

                                    @case('Remote')
                                        <span class="badge bg-info px-3">
                                            Remote
                                        </span>
                                    @break

                                    @case('Kunjungan Lokasi')
                                        <span class="badge bg-secondary px-3">
                                            Kunjungan
                                        </span>
                                    @break

                                    @case('Menunggu Sparepart')
                                        <span class="badge bg-dark px-3">
                                            Sparepart
                                        </span>
                                    @break

                                    @case('Selesai')
                                        <span class="badge bg-success px-3">
                                            Selesai
                                        </span>
                                    @break

                                    @default
                                        <span class="badge bg-light text-dark">
                                            {{ $complaint->status }}
                                        </span>

                                @endswitch

                            </td>

                            <td class="text-center">

                                {{ \Carbon\Carbon::parse($complaint->tanggal_lapor)->format('d M Y') }}

                            </td>

                            <td class="text-center">

                                @role('admin')

                                    <a
                                        href="{{ route('complaints.edit',$complaint->id) }}"
                                        class="btn btn-warning btn-sm mb-1"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('complaints.destroy',$complaint->id) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus laporan ini?')"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                @elserole('teknisi')

                                    <a
                                        href="{{ route('complaints.edit',$complaint->id) }}"
                                        class="btn btn-primary btn-sm"
                                    >
                                        Update
                                    </a>

                                @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                @endrole

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10" class="text-center py-4">

                                <h6 class="text-muted mb-0">

                                    Belum ada data laporan.

                                </h6>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="d-flex justify-content-end">

                {{ $complaints->links() }}

            </div>

        </div>

    </div>

</div>

@endsection