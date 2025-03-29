<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $primaryKey = 'article_id';

    protected $fillable = [
        'title',
        'body',
        'create_date',
        'start_date',
        'end_date',
        'contributor_username',
    ];

    protected $casts = [
        'create_date' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public $timestamps = true;
}
