<?php

namespace App\Models\user;

use App\Models\booking\booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'npm',
        'email',
        'password',
        'prodi',
        'id_major',
        'class_year',
        'id_role',
        'is_active',
    ];
    public function major()
    {
        return $this->belongsTo(master_major::class, 'id_major');
    }
    public function bookings()
    {
        return $this->hasMany(booking::class, 'user_id','id');
    }


}
