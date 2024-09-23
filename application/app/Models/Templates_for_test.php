<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    protected $fillable = [
        'slug',
        'title',
        'structure',
        'evaluation_criteria',
        'jury_members'
    ];
    protected $casts = [
        'structure' => 'json',
        'evaluation_criteria' => 'json',
        'jury_members' => 'json',
    ];

    // protected $with = ['jury_members_mave'];
    // public function jury_mave()
    // {
    //     return $this->belongsToJson(User::class, 'jury_members[]', 'id');
    // }
}
