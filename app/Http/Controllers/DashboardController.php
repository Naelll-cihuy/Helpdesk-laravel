<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Room;
use App\Models\Device;
use App\Models\Category;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin', [

            'totalUser'       => User::count(),
            'totalAdmin'      => User::role('admin')->count(),
            'totalTeknisi'    => User::role('teknisi')->count(),

            'totalRoom'       => Room::count(),
            'totalCategory'   => Category::count(),
            'totalDevice'     => Device::count(),
            'totalComplaint'  => Complaint::count(),

            'pending' => Complaint::where('status', 'Pending')->count(),

            'diproses' => Complaint::whereIn('status', [
                'Diproses',
                'Remote',
                'Kunjungan Lokasi',
                'Menunggu Sparepart'
            ])->count(),

            'selesai' => Complaint::where('status', 'Selesai')->count(),

            'complaints' => Complaint::with([
                'user',
                'device.room',
                'technician'
            ])
            ->latest()
            ->take(5)
            ->get(),

        ]);
    }

    public function teknisi()
{
    $pending = Complaint::where('status','Pending')->count();

    $diproses = Complaint::where('status','Diproses')->count();

    $selesai = Complaint::where('status','Selesai')->count();

    $complaints = Complaint::with([
        'user',
        'device.room'
    ])
    ->latest()
    ->take(5)
    ->get();

    return view('dashboard.teknisi', compact(
        'pending',
        'diproses',
        'selesai',
        'complaints'
    ));
}

    public function user()
{
    $user = auth()->user();

    $total = Complaint::where('user_id',$user->id)->count();

    $pending = Complaint::where('user_id',$user->id)
        ->where('status','Pending')
        ->count();

    $diproses = Complaint::where('user_id',$user->id)
        ->where('status','Diproses')
        ->count();

    $selesai = Complaint::where('user_id',$user->id)
        ->where('status','Selesai')
        ->count();

    $complaints = Complaint::with('device')
        ->where('user_id',$user->id)
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard.user', compact(
        'total',
        'pending',
        'diproses',
        'selesai',
        'complaints'
    ));
}
}