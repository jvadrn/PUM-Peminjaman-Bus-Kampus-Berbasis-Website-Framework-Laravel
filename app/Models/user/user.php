<?php

namespace App\Models\user;

use App\Models\booking\booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Model
{
    use HasFactory;
    use HasApiTokens;
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
