<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
    'kode_laporan',
    'user_id',
    'device_id',
    'technician_id',
    'judul',
    'deskripsi',
    'foto',
    'tanggal_lapor',
    'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function histories()
    {
        return $this->hasMany(ComplaintHistory::class);
    }
}