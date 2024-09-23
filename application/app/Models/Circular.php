<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Circular extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    protected $table = 'circular';
    protected $fillable = [
        'slug',
        'template_id',
        'title',
        'description',
        'jury_members',
        'cover_image_id',
        'deadline',
        'status'
    ];


    protected $casts = [
        'jury_members' => 'array',
    ];

    protected $with = [
        'cover_image_mave',
        'template_mave',
        'jury_members_mave'
    ];
    public function cover_image_mave()
    {
        return $this->belongsTo(Media::class, 'cover_image_id', 'id');
    }

    public function template_mave()
    {
        return $this->belongsTo(Template::class, 'template_id', 'id');
    }

    public function jury_members_mave()
    {
        return $this->belongsToJson(User::class, 'jury_members', 'id');
    }
}
