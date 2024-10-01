<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Template extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    protected $fillable = [
        'slug', 'title', 'structure', 'evaluation_criteria', 'jury_members'
    ];


    protected $casts = [
        'structure' => 'array',
        'jury_members' => 'array',
    ];

    // protected $with = ['jury_members_mave'];

    public function jury_members_mave()
    {
        return $this->belongsToJson(User::class, 'jury_members', 'id');
    }
}
