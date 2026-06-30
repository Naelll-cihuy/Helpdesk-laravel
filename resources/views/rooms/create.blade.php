@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-header">

                    <h4 class="mb-0">
                        Tambah Ruangan
                    </h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('rooms.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Kode Ruangan
                            </label>

                            <input
                                type="text"
                                name="kode_ruangan"
                                class="form-control @error('kode_ruangan') is-invalid @enderror"
                                value="{{ old('kode_ruangan') }}"
                                placeholder="Contoh : R001"
                                required
                            >

                            @error('kode_ruangan')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Nama Ruangan
                            </label>

                            <input
                                type="text"
                                name="nama_ruangan"
                                class="form-control @error('nama_ruangan') is-invalid @enderror"
                                value="{{ old('nama_ruangan') }}"
                                placeholder="Contoh : Lab Komputer 1"
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

                            <button type="submit" class="btn btn-primary">

                                Simpan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
