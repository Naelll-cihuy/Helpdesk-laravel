@extends('layouts.app')

@section('content')

<div class="container">

```
<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow-sm">

            <div class="card-header">

                <h4 class="mb-0">
                    Tambah Kategori
                </h4>

            </div>

            <div class="card-body">

                <form action="{{ route('categories.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">

                        <label class="form-label">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            name="nama_kategori"
                            class="form-control @error('nama_kategori') is-invalid @enderror"
                            value="{{ old('nama_kategori') }}"
                            placeholder="Contoh : Monitor"
                            required
                        >

                        @error('nama_kategori')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Kode Kategori
                        </label>

                        <input
                            type="text"
                            name="kode_kategori"
                            class="form-control @error('kode_kategori') is-invalid @enderror"
                            value="{{ old('kode_kategori') }}"
                            placeholder="Contoh : MON"
                            maxlength="3"
                            style="text-transform:uppercase"
                            required
                        >

                        @error('kode_kategori')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <div class="d-flex justify-content-between">

                        <a href="{{ route('categories.index') }}"
                           class="btn btn-secondary">

                            Kembali

                        </a>

                        <button class="btn btn-primary">

                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
```

</div>

@endsection
