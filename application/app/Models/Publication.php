<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    protected $fillable = [
        'template_id',
        'author_id',
        'cover_image_id',
        'title',
        'author_name',
        'date',
        'contents',
        'ebook',
        'approval_status',
        'approved_by',
        'approved_at',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'contents' => 'json',
        'approved_at' => 'datetime',
    ];

    protected $with = ['author_mave', 'cover_image_mave'];

    public function templates_mave()
    {
        return $this->belongsTo(Templates::class, 'template_id');
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
