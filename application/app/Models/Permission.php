<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'group',
        'title',
        'slug',
        'status'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permissions');
    }
}
