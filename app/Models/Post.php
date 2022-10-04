<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    const LIMIT = 50;

    protected $guarded = [ 'id' ];

    protected $dates = [ 'publication_date' ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function excerpt()
    {
        return Str::limit($this->description, self::LIMIT);
    }
}
