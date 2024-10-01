<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{

    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    protected $fillable = [
        'template_id',
        'circular_id',
        'author_id',
        'cover_image_id',
        'title',
        'author_name',
        'date',
        'form_data',
        'author_id',
        'slug',
        'jury_members',
        'approval_status',
        'approved_by',
        'approved_at',
        'status'
    ];

    protected $casts = [
        'date' => 'date',
        'form_data' => 'json',
        'jury_members' => 'array',
        'approved_at' => 'datetime',
    ];

    protected $with = ['templates_mave', 'author_mave', 'cover_image_mave'];

    public function templates_mave()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }
    public function circular_mave()
    {
        return $this->belongsTo(Circular::class, 'circular_id');
    }
    public function author_mave()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function cover_image_mave()
    {
        return $this->belongsTo(Media::class, 'cover_image_id');
    }
}
