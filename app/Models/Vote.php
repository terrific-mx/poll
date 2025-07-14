<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /** @use HasFactory<\Database\Factories\VoteFactory> */
    use HasFactory;

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
