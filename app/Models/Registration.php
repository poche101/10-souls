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
        'kingschat_handle',
        'souls_commitment',
        'avatar_path',
    ];
}
