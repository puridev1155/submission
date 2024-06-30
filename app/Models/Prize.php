<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;

    protected $fillable = [
        'vol',
        'award',
        'name',
        'email',
        'phone',
        'wip',
        'agree',
        'success',
        'counts',
        'device'        
    ];
}
