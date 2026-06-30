<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Helpdesk</title>

@vite([
'resources/sass/app.scss',
'resources/js/app.js'
])

<style>

body{
margin:0;
font-family:Arial,Helvetica,sans-serif;
background:linear-gradient(135deg,#0d6efd,#3c8dff);
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

.card{
width:900px;
max-width:95%;
background:white;
border-radius:20px;
overflow:hidden;
box-shadow:0 20px 60px rgba(0,0,0,.2);
}

.row{
display:flex;
flex-wrap:wrap;
}

.left{
flex:1;
padding:60px;
}

.right{
flex:1;
background:#f8f9fa;
display:flex;
justify-content:center;
align-items:center;
padding:40px;
}

.logo{
font-size:70px;
margin-bottom:15px;
}

h1{
font-size:45px;
margin-bottom:10px;
}

.desc{
color:#666;
line-height:1.7;
margin-bottom:35px;
}

.btn{
display:inline-block;
padding:13px 28px;
border-radius:10px;
text-decoration:none;
font-weight:bold;
margin-right:10px;
transition:.2s;
}

.btn-primary{
background:#0d6efd;
color:white;
}

.btn-primary:hover{
background:#0b5ed7;
}

.btn-outline{
border:2px solid #0d6efd;
color:#0d6efd;
}

.btn-outline:hover{
background:#0d6efd;
color:white;
}

.box{
background:white;
padding:20px;
border-radius:15px;
margin-bottom:15px;
box-shadow:0 3px 12px rgba(0,0,0,.08);
}

.box h3{
margin-bottom:8px;
}

.footer{
padding:20px;
text-align:center;
color:#777;
border-top:1px solid #eee;
font-size:14px;
}

</style>

</head>

<body>

<div class="card">

<div class="row">

<div class="left">

<div class="logo">🖥️</div>

<h1>Helpdesk</h1>

<p class="desc">

Sistem pelaporan kerusakan perangkat yang memudahkan pengguna
membuat laporan, memantau proses perbaikan, dan membantu teknisi
menangani setiap kendala dengan lebih cepat.

</p>

@guest

<a href="{{ route('login') }}" class="btn btn-primary">
Login
</a>

@if(Route::has('register'))

<a href="{{ route('register') }}" class="btn btn-outline">
Register
</a>

@endif

@endguest

@auth

@if(auth()->user()->hasRole('admin'))

<a href="{{ route('dashboard.admin') }}" class="btn btn-primary">
Masuk Dashboard
</a>

@elseif(auth()->user()->hasRole('teknisi'))

<a href="{{ route('dashboard.teknisi') }}" class="btn btn-primary">
Masuk Dashboard
</a>

@else

<a href="{{ route('dashboard.user') }}" class="btn btn-primary">
Masuk Dashboard
</a>

@endif

@endauth

</div>

<div class="right">

<div>

<div class="box">

<h3>📄 Laporan</h3>

<p>Buat laporan kerusakan dengan cepat.</p>

</div>

<div class="box">

<h3>🛠 Teknisi</h3>

<p>Kelola proses perbaikan secara terstruktur.</p>

</div>

<div class="box">

<h3>📊 Dashboard</h3>

<p>Pantau seluruh aktivitas sesuai hak akses.</p>

</div>

</div>

</div>

</div>

<div class="footer">

© {{ date('Y') }} Helpdesk

</div>

</div>

</body>

</html>
