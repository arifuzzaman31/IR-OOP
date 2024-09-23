<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluation';
    protected $fillable = [
        'jury_id',
        'ebook_id',
        'evaluation',
        'total_mark',
        'status',
    ];


    protected $casts = [
        'evaluation' => 'array'
    ];

    protected $with = ['jury_mave', 'ebook_mave'];

    public function jury_mave()
    {
        return $this->belongsTo(User::class, 'jury_id');
    }
    public function ebook_mave()
    {
        return $this->belongsTo(Ebook::class, 'ebook_id');
    }
}
