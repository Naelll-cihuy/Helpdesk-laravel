@extends('layouts.app')

@section('content')

<div class="container">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2>Data Perangkat</h2>

<small class="text-muted">

Total Perangkat : <strong>{{ $devices->count() }}</strong>

</small>

</div>

<a href="{{ route('devices.create') }}" class="btn btn-primary">

+ Tambah Perangkat

</a>

</div>

<div class="card shadow-sm">

<div class="card-body">

<table class="table table-hover align-middle">

<thead class="table-dark">

<tr>

<th>Kode</th>

<th>Nama</th>

<th>Kategori</th>

<th>Ruangan</th>

<th>Merk</th>

<th>Status</th>

<th width="150">Aksi</th>

</tr>

</thead>

<tbody>

@forelse($devices as $device)

<tr>

<td>

<strong>{{ $device->kode_perangkat }}</strong>

</td>

<td>{{ $device->nama_perangkat }}</td>

<td>

<span class="badge bg-secondary">

{{ $device->category->nama_kategori }}

</span>

</td>

<td>

<strong>{{ $device->room->kode_ruangan }}</strong>

<br>

<small class="text-muted">

{{ $device->room->nama_ruangan }}

</small>

</td>

<td>{{ $device->merk }}</td>

<td>

@if($device->status=="Aktif")

<span class="badge bg-success">Aktif</span>

@elseif($device->status=="Rusak")

<span class="badge bg-danger">Rusak</span>

@else

<span class="badge bg-secondary">

{{ $device->status }}

</span>

@endif

</td>

<td>

<a href="{{ route('devices.edit',$device->id) }}" class="btn btn-warning btn-sm">

Edit

</a>

<form action="{{ route('devices.destroy',$device->id) }}" method="POST" class="d-inline">

@csrf

@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Hapus perangkat?')">

Hapus

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center">

Belum ada perangkat.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

@endsection