<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_role extends Model
{
    use HasFactory;
    protected $table ="master_role";
    protected $fillable = [
        'name',
    ];
}
