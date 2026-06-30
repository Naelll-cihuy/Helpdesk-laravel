@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">
        Buat Laporan
    </h2>

    <form
        action="{{ route('complaints.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="mb-3 position-relative">

            <label class="form-label">
                Cari Perangkat
            </label>

            <input
                type="text"
                id="searchDevice"
                class="form-control"
                placeholder="Contoh : Monitor, Keyboard, Ruang IT..."
                autocomplete="off"
            >

            <input
                type="hidden"
                name="device_id"
                id="device_id"
                required
            >

            <div
                id="suggestions"
                class="list-group shadow"
                style="
                    display:none;
                    position:absolute;
                    width:100%;
                    z-index:999;
                    max-height:250px;
                    overflow-y:auto;
                "
            ></div>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Judul Keluhan
            </label>

            <input
                type="text"
                name="judul"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">
                Deskripsi Keluhan
            </label>

            <textarea
                name="deskripsi"
                class="form-control"
                rows="5"
                required
            ></textarea>

        </div>

        <div class="mb-4">

            <label class="form-label">
                Foto Kerusakan
            </label>

            <input
                type="file"
                name="foto"
                class="form-control"
            >

        </div>

        <button
            class="btn btn-primary"
        >
            Kirim Laporan
        </button>

    </form>

</div>

<script>

const devices = [

@foreach($devices as $device)

{

    id: "{{ $device->id }}",

    nama: "{{ $device->nama_perangkat }}",

    ruang: "{{ $device->room->nama_ruangan }}",

    kode: "{{ $device->kode_perangkat }}"

},

@endforeach

];

const input = document.getElementById('searchDevice');
const hidden = document.getElementById('device_id');
const list = document.getElementById('suggestions');

input.addEventListener('input', function(){

    let keyword = this.value.toLowerCase().trim();

    list.innerHTML = "";

    if(keyword.length < 1){

        list.style.display = "none";
        hidden.value = "";
        return;

    }

    const hasil = devices.filter(d =>

        d.nama.toLowerCase().includes(keyword) ||
        d.ruang.toLowerCase().includes(keyword) ||
        d.kode.toLowerCase().includes(keyword)

    );

    if(hasil.length == 0){

        list.style.display = "none";
        hidden.value = "";
        return;

    }

    hasil.forEach(d=>{

        let item = document.createElement("a");

        item.href="#";

        item.className="list-group-item list-group-item-action";

        item.innerHTML=`
            <strong>${d.nama}</strong><br>
            <small>${d.ruang} • ${d.kode}</small>
        `;

        item.onclick=function(e){

            e.preventDefault();

            input.value=d.nama+" - "+d.ruang+" ("+d.kode+")";

            hidden.value=d.id;

            list.style.display="none";

        }

        list.appendChild(item);

    });

    list.style.display="block";

});

document.addEventListener("click",function(e){

    if(!document.querySelector(".position-relative").contains(e.target)){

        list.style.display="none";

    }

});

</script>

@endsection