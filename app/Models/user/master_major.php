<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_major extends Model
{
    use HasFactory;
    protected $table ="master_major";
    protected $fillable = [
        'name',
    ];
    protected $primaryKey = 'id';

}
