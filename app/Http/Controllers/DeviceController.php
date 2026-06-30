<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Room;
use App\Models\Category;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::with(['room', 'category'])->get();

        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        $rooms = Room::all();
        $categories = Category::all();

        return view('devices.create', compact('rooms', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perangkat' => 'required',
            'category_id' => 'required',
            'room_id' => 'required',
            'merk' => 'required',
            'status' => 'required'
        ]);

        // Ambil kategori yang dipilih
$category = Category::findOrFail($request->category_id);

// Ambil prefix kategori (MON, KEY, MOU, dll)
$prefix = strtoupper($category->kode_kategori);

// Cari perangkat terakhir berdasarkan prefix kategori
$lastDevice = Device::where('kode_perangkat', 'like', $prefix . '%')
    ->orderBy('kode_perangkat', 'desc')
    ->first();

if ($lastDevice) {

    $lastNumber = (int) substr($lastDevice->kode_perangkat, 3);

    $newNumber = $lastNumber + 1;

} else {

    $newNumber = 1;

}

$kodePerangkat = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        Device::create([
            'kode_perangkat' => $kodePerangkat,
            'nama_perangkat' => $request->nama_perangkat,
            'category_id' => $request->category_id,
            'room_id' => $request->room_id,
            'merk' => $request->merk,
            'status' => $request->status
        ]);

        return redirect()->route('devices.index')
            ->with('success', 'Perangkat berhasil ditambahkan.');
    }

    public function show(Device $device)
    {
        //
    }

    public function edit(Device $device)
    {
        $rooms = Room::all();
        $categories = Category::all();

        return view('devices.edit', compact(
            'device',
            'rooms',
            'categories'
        ));
    }

    public function update(Request $request, Device $device)
    {
        $request->validate([
            'nama_perangkat' => 'required',
            'category_id' => 'required',
            'room_id' => 'required',
            'merk' => 'required',
            'status' => 'required'
        ]);

        $device->update([
            // kode_perangkat sengaja tidak diubah
            'nama_perangkat' => $request->nama_perangkat,
            'category_id' => $request->category_id,
            'room_id' => $request->room_id,
            'merk' => $request->merk,
            'status' => $request->status
        ]);

        return redirect()->route('devices.index')
            ->with('success', 'Perangkat berhasil diupdate.');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')
            ->with('success', 'Perangkat berhasil dihapus.');
    }
}
