<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Helpdesk') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=Nunito"
        rel="stylesheet"
    >

    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js'
    ])
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

<div id="app">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">

<div class="container">

<a
    class="navbar-brand fw-bold"
    href="/"
>

🖥 Helpdesk

</a>

<button
    class="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent"
>

<span class="navbar-toggler-icon"></span>

</button>

<div
    class="collapse navbar-collapse"
    id="navbarSupportedContent"
>

<ul class="navbar-nav me-auto">

@auth

    @role('admin')

    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.admin') }}">
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('rooms.index') }}">
            Ruangan
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">
            Kategori
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('devices.index') }}">
            Perangkat
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('complaints.index') }}">
            Data Laporan
        </a>
    </li>

    @endrole


    @role('teknisi')

    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.teknisi') }}">
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('complaints.index') }}">
            Laporan Masuk
        </a>
    </li>

    @endrole


    @role('user')

    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.user') }}">
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('complaints.create') }}">
            Buat Laporan
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('complaints.index') }}">
            Riwayat Laporan
        </a>
    </li>

    @endrole

@endauth

</ul>

<ul class="navbar-nav ms-auto">

@guest

@if(Route::has('login'))

<li class="nav-item">

<a
class="nav-link"
href="{{ route('login') }}"
>

Login

</a>

</li>

@endif

@if(Route::has('register'))

<li class="nav-item">

<a
class="nav-link"
href="{{ route('register') }}"
>

Register

</a>

</li>

@endif

@else

<li class="nav-item dropdown">

<a
class="nav-link dropdown-toggle"
href="#"
role="button"
data-bs-toggle="dropdown"
>

{{ Auth::user()->name }}

@if(auth()->user()->hasRole('admin'))

<span class="badge bg-danger ms-1">
Admin
</span>

@elseif(auth()->user()->hasRole('teknisi'))

<span class="badge bg-warning text-dark ms-1">
Teknisi
</span>

@else

<span class="badge bg-success ms-1">
User
</span>

@endif

</a>

<ul class="dropdown-menu dropdown-menu-end">

<li>

<a
class="dropdown-item"
href="#"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();"
>

Logout

</a>

</li>

</ul>

<form
id="logout-form"
action="{{ route('logout') }}"
method="POST"
class="d-none"
>

@csrf

</form>

</li>

@endguest

</ul>

</div>

</div>

</nav>

<main class="py-4">

<div class="container">

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

{{ session('success') }}

<button
type="button"
class="btn-close"
data-bs-dismiss="alert"
></button>

</div>

@endif

@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show">

{{ session('error') }}

<button
type="button"
class="btn-close"
data-bs-dismiss="alert"
></button>

</div>

@endif

</div>

@yield('content')

</main>

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>