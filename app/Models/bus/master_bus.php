<?php

namespace App\Models\bus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_bus extends Model
{
    use HasFactory;
    protected $table ="master_bus";
    protected $fillable = [
        'name',
    ];
}
