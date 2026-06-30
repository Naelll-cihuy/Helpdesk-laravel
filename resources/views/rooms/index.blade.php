@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Data Ruangan</h2>
            <small class="text-muted">
                Total Ruangan : <strong>{{ $rooms->count() }}</strong>
            </small>
        </div>

        <a href="{{ route('rooms.create') }}" class="btn btn-primary">
            + Tambah Ruangan
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th width="80">No</th>
                        <th>Kode Ruangan</th>
                        <th>Nama Ruangan</th>
                        <th width="150">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($rooms as $room)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>{{ $room->kode_ruangan }}</strong>
                        </td>

                        <td>{{ $room->nama_ruangan }}</td>

                        <td>

                            <a href="{{ route('rooms.edit',$room->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('rooms.destroy',$room->id) }}" method="POST" class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus ruangan?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4" class="text-center">

                            Belum ada data.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection