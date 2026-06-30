@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-header">

                    <h4 class="mb-0">
                        Edit Ruangan
                    </h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('rooms.update',$room->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">
                                Kode Ruangan
                            </label>

                            <input
                                type="text"
                                name="kode_ruangan"
                                class="form-control @error('kode_ruangan') is-invalid @enderror"
                                value="{{ old('kode_ruangan',$room->kode_ruangan) }}"
                                required
                            >

                            @error('kode_ruangan')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Nama Ruangan
                            </label>

                            <input
                                type="text"
                                name="nama_ruangan"
                                class="form-control @error('nama_ruangan') is-invalid @enderror"
                                value="{{ old('nama_ruangan',$room->nama_ruangan) }}"
                                required
                            >

                            @error('nama_ruangan')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>

                            <button class="btn btn-primary">
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection