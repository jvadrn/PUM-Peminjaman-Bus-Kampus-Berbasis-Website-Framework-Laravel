<?php

namespace App\Models\booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $fillable = ['peminjaman_id', 'pesan'];

    public function peminjaman()
    {
        return $this->belongsTo(Booking::class, 'peminjaman_id', 'id');
    }
}
