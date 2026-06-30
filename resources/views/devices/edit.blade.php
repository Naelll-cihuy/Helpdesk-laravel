@extends('layouts.app')

@section('content')

<div class="container">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card shadow-sm">

<div class="card-header">

<h4 class="mb-0">Edit Perangkat</h4>

</div>

<div class="card-body">

<form action="{{ route('devices.update',$device->id) }}" method="POST">

@csrf
@method('PUT')

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">Kode Perangkat</label>

<input
type="text"
name="kode_perangkat"
class="form-control"
value="{{ old('kode_perangkat',$device->kode_perangkat) }}"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Nama Perangkat</label>

<input
type="text"
name="nama_perangkat"
class="form-control"
value="{{ old('nama_perangkat',$device->nama_perangkat) }}"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Kategori</label>

<select
name="category_id"
class="form-select">

@foreach($categories as $category)

<option
value="{{ $category->id }}"
{{ old('category_id',$device->category_id)==$category->id?'selected':'' }}>

{{ $category->nama_kategori }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Ruangan</label>

<select
name="room_id"
class="form-select">

@foreach($rooms as $room)

<option
value="{{ $room->id }}"
{{ old('room_id',$device->room_id)==$room->id?'selected':'' }}>

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
value="{{ old('merk',$device->merk) }}">

</div>

<div class="col-md-12 mb-4">

<label class="form-label">Status</label>

<select
name="status"
class="form-select">

<option value="Aktif" {{ $device->status=='Aktif'?'selected':'' }}>
Aktif
</option>

<option value="Rusak" {{ $device->status=='Rusak'?'selected':'' }}>
Rusak
</option>

<option value="Maintenance" {{ $device->status=='Maintenance'?'selected':'' }}>
Maintenance
</option>

</select>

</div>

</div>

<div class="d-flex justify-content-between">

<a href="{{ route('devices.index') }}" class="btn btn-secondary">

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

</div>

@endsection
