<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'poll_id',
        'answer_id',
        'contact_email',
    ];
    use HasFactory;

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    /** @use HasFactory<\Database\Factories\ResponseFactory> */
    use HasFactory;
}
