@extends('layouts.app')

@section('content')

<div class="container">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2>Data Kategori</h2>

<small class="text-muted">

Total Kategori : <strong>{{ $categories->count() }}</strong>

</small>

</div>

<a href="{{ route('categories.create') }}" class="btn btn-primary">

+ Tambah Kategori

</a>

</div>

<div class="card shadow-sm">

<div class="card-body">

<table class="table table-hover align-middle">

<thead class="table-dark">

<tr>

<th width="80">No</th>

<th>Nama Kategori</th>

<th width="150">Aksi</th>

</tr>

</thead>

<tbody>

@forelse($categories as $category)

<tr>

<td>{{ $loop->iteration }}</td>

<td>

<strong>{{ $category->nama_kategori }}</strong>

</td>

<td>

<a href="{{ route('categories.edit',$category->id) }}" class="btn btn-warning btn-sm">

Edit

</a>

<form action="{{ route('categories.destroy',$category->id) }}" method="POST" class="d-inline">

@csrf

@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Hapus kategori?')">

Hapus

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="3" class="text-center">

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