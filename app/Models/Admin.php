<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'company_id', 'name', 'email', 'password', 'phone', 'address', 'is_active'
    ];

    protected $hidden = [
        'password',
    ];
}
