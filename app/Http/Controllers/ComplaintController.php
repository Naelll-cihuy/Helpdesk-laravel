<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Complaint;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index(Request $request)
{
    $query = Complaint::with([
        'user',
        'device.room',
        'technician'
    ]);

    // Search
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('kode_laporan', 'like', "%{$search}%")
              ->orWhere('judul', 'like', "%{$search}%")
              ->orWhereHas('user', function ($q) use ($search) {

                    $q->where('name', 'like', "%{$search}%");

              })
              ->orWhereHas('device', function ($q) use ($search) {

                    $q->where('nama_perangkat', 'like', "%{$search}%");

              });

        });

    }

    // Filter Status
    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    // Filter Tanggal Awal
    if ($request->filled('tanggal_awal')) {

        $query->whereDate(
            'tanggal_lapor',
            '>=',
            $request->tanggal_awal
        );

    }

    // Filter Tanggal Akhir
    if ($request->filled('tanggal_akhir')) {

        $query->whereDate(
            'tanggal_lapor',
            '<=',
            $request->tanggal_akhir
        );

    }

    $complaints = $query
        ->latest('tanggal_lapor')
        ->paginate(10)
        ->withQueryString();

    return view('complaints.index', compact('complaints'));
}

    public function create()
    {
        $devices = Device::with([
        'room',
        'category'
        ])
            ->orderBy('nama_perangkat')
            ->get();

        return view('complaints.create', compact('devices'));
    }

    public function store(Request $request)
{
    $request->validate([
        'device_id' => 'required|exists:devices,id',
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
    ]);

    $namaFoto = null;

    if ($request->hasFile('foto')) {

    $manager = new ImageManager(new Driver());

    $image = $manager->read($request->file('foto'));

    $image->scaleDown(width: 1280);

    $namaFoto = 'complaints/' . time() . '.jpg';

    $image
        ->toJpeg(70)
        ->save(storage_path('app/public/' . $namaFoto));
}

    Complaint::create([
        'kode_laporan' => 'LPR-' . now()->format('YmdHis') . rand(100,999),
        'user_id' => auth()->id(),
        'device_id' => $request->device_id,
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'foto' => $namaFoto,
        'tanggal_lapor' => now(),
        'status' => 'Pending',
    ]);

    return redirect()
        ->route('complaints.index')
        ->with('success', 'Laporan berhasil dibuat.');
}

    public function show(Complaint $complaint)
    {
        return view('complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint)
    {
        $devices = Device::with([
        'room',
        'category'
    ])
    ->orderBy('nama_perangkat')
    ->get();

    return view(
        'complaints.edit',
        compact('complaint', 'devices')
    );

    }

    public function update(Request $request, Complaint $complaint)
{
    $request->validate([
        'device_id' => 'required|exists:devices,id',
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        'status' => 'required',
    ]);

    $namaFoto = $complaint->foto;

    if ($request->hasFile('foto')) {

    if ($complaint->foto) {
        Storage::disk('public')->delete($complaint->foto);
    }

    $manager = new ImageManager(new Driver());

    $image = $manager->read($request->file('foto'));

    $image->scaleDown(width: 1280);

    $namaFoto = 'complaints/' . time() . '.jpg';

    $image
        ->toJpeg(70)
        ->save(storage_path('app/public/' . $namaFoto));
}

    $complaint->update([
        'device_id' => $request->device_id,
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'foto' => $namaFoto,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('complaints.index')
        ->with('success', 'Laporan berhasil diupdate.');
}

    public function destroy(Complaint $complaint)
    {
        if ($complaint->foto) {

            Storage::disk('public')
                ->delete($complaint->foto);

        }

        $complaint->delete();

        return redirect()
            ->route('complaints.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    public function take(Complaint $complaint)
{
    $complaint->update([

        'technician_id' => auth()->id(),

        'status' => 'Diproses'

    ]);

    return back()->with('success','Laporan berhasil diambil.');
}
}