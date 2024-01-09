<?php

namespace App\Models\bus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bus extends Model
{
    use HasFactory;
    protected $table = "bus";
    protected $fillable = [
        'name',
        'number_vehicle',
        'colour',
        'type',
    ];
}
