<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required|unique:rooms',
            'nama_ruangan' => 'required'
        ]);

        Room::create([
            'kode_ruangan' => $request->kode_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'keterangan' => $request->keterangan
        ]);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Data ruangan berhasil ditambahkan');
    }

    public function show(Room $room)
    {
        //
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'kode_ruangan' => 'required|unique:rooms,kode_ruangan,' . $room->id,
            'nama_ruangan' => 'required'
        ]);

        $room->update([
            'kode_ruangan' => $request->kode_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'keterangan' => $request->keterangan
        ]);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Data ruangan berhasil diupdate');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Data ruangan berhasil dihapus');
    }
}