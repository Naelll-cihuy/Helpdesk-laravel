@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Edit Laporan</h2>

    <form
        action="{{ route('complaints.update',$complaint->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Perangkat</label>

            <select
                name="device_id"
                class="form-control"
                required
            >

                @foreach($devices as $device)

                    <option
                        value="{{ $device->id }}"
                        {{ $complaint->device_id == $device->id ? 'selected' : '' }}
                    >

                        {{ $device->kode_perangkat }}
                        -
                        {{ $device->nama_perangkat }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Judul</label>

            <input
                type="text"
                name="judul"
                value="{{ $complaint->judul }}"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label>Deskripsi</label>

            <textarea
                name="deskripsi"
                class="form-control"
                rows="5"
                required
            >{{ $complaint->deskripsi }}</textarea>

        </div>

        <div class="mb-3">

            @if($complaint->foto)

                <img
                    src="{{ asset('storage/'.$complaint->foto) }}"
                    width="250"
                    class="img-thumbnail"
                >

            @endif

        </div>

        <div class="mb-3">

            <label>Ganti Foto</label>

            <input
                type="file"
                name="foto"
                class="form-control"
                accept=".jpg,.jpeg,.png"
            >

        </div>

        <div class="mb-3">

            <label>Status</label>

            <select
                name="status"
                class="form-control"
            >

                <option {{ $complaint->status == 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option {{ $complaint->status == 'Diproses' ? 'selected' : '' }}>
                    Diproses
                </option>

                <option {{ $complaint->status == 'Remote' ? 'selected' : '' }}>
                    Remote
                </option>

                <option {{ $complaint->status == 'Kunjungan Lokasi' ? 'selected' : '' }}>
                    Kunjungan Lokasi
                </option>

                <option {{ $complaint->status == 'Menunggu Sparepart' ? 'selected' : '' }}>
                    Menunggu Sparepart
                </option>

                <option {{ $complaint->status == 'Selesai' ? 'selected' : '' }}>
                    Selesai
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="btn btn-success"
        >
            Update
        </button>

    </form>

</div>

@endsection