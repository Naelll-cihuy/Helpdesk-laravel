<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_perangkat',
        'nama_perangkat',
        'category_id',
        'room_id',
        'merk',
        'serial_number',
        'status'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}