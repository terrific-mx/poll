<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /** @use HasFactory<\Database\Factories\OptionFactory> */
    use HasFactory;

    protected $guarded = [];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function percent(): int
    {
        $total = Response::where('poll_id', $this->poll_id)->count();

        if ($total === 0) {
            return 0;
        }

        $count = Response::where('option_id', $this->id)->count();

        return round(($count / $total) * 100, 0);
    }
}
