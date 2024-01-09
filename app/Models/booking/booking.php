<?php

namespace App\Models\booking;

use App\Models\user\user;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $table ="booking";
    protected $fillable = [
        'nameActivity',
        'destination',
        'image_latter',
        'id_status',
        'id_major',
        'departure_date',
        'date_finish',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id','id'  );
    }
    
}
