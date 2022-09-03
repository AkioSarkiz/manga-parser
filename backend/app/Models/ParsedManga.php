<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParsedManga extends Model
{
    use HasFactory;

    protected $fillable = [
        'source', 'key', 'raw_data', 'parsed_data',
    ];

    protected $casts = [
        'parsed_data' => 'array',
    ];
}
