<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'title',
        'full_name',
        'phone_number',
        'cell',
        'church',
        'group',
        'souls_commitment',
        'avatar_path',
    ];
}
