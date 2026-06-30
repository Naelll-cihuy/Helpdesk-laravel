@extends('layouts.app')

@section('content')

<div class="container">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card shadow-sm">

<div class="card-header">

<h4 class="mb-0">Tambah Perangkat</h4>

</div>

<div class="card-body">

<form action="{{ route('devices.store') }}" method="POST">

@csrf

<div class="row">

<div class="col-md-6 mb-3">

    <label class="form-label">
        Kode Perangkat
    </label>

    <input
        type="text"
        class="form-control"
        value="Otomatis dibuat setelah disimpan"
        readonly
    >

    <small class="text-muted">
        Kode perangkat akan dibuat otomatis berdasarkan kategori.
    </small>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Nama Perangkat</label>

<input
type="text"
name="nama_perangkat"
class="form-control @error('nama_perangkat') is-invalid @enderror"
value="{{ old('nama_perangkat') }}"
placeholder="Contoh : Komputer Lab 1"
required>

@error('nama_perangkat')

<div class="invalid-feedback">{{ $message }}</div>
@enderror

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Kategori</label>

<select
name="category_id"
class="form-select @error('category_id') is-invalid @enderror"
required>

<option value="">Pilih Kategori</option>

@foreach($categories as $category)

<option
value="{{ $category->id }}"
{{ old('category_id')==$category->id?'selected':'' }}>

{{ $category->nama_kategori }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Ruangan</label>

<select
name="room_id"
class="form-select @error('room_id') is-invalid @enderror"
required>

<option value="">Pilih Ruangan</option>

@foreach($rooms as $room)

<option
value="{{ $room->id }}"
{{ old('room_id')==$room->id?'selected':'' }}>

{{ $room->kode_ruangan }} - {{ $room->nama_ruangan }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Merk</label>

<input
type="text"
name="merk"
class="form-control"
value="{{ old('merk') }}"
placeholder="HP / Lenovo / Asus">

</div>

<div class="col-md-12 mb-4">

<label class="form-label">Status</label>

<select name="status" class="form-select">

<option value="Aktif">Aktif</option>
<option value="Rusak">Rusak</option>
<option value="Maintenance">Maintenance</option>

</select>

</div>

</div>

<div class="d-flex justify-content-between">

<a href="{{ route('devices.index') }}" class="btn btn-secondary">

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

</div>

@endsection
