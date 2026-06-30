@extends('layouts.app')

@section('content')

<div class="container">

```
<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow-sm">

            <div class="card-header">

                <h4 class="mb-0">
                    Edit Kategori
                </h4>

            </div>

            <div class="card-body">

                <form action="{{ route('categories.update',$category->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="form-label">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            name="nama_kategori"
                            class="form-control @error('nama_kategori') is-invalid @enderror"
                            value="{{ old('nama_kategori',$category->nama_kategori) }}"
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
                            value="{{ old('kode_kategori',$category->kode_kategori) }}"
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

                            Update

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
