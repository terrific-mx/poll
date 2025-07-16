<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    /** @use HasFactory<\Database\Factories\PollFactory> */
    use HasFactory;

    public function addResponse(Answer $answer, $contact_email = null)
    {
        return $this->responses()->create([
            'answer_id' => $answer->id,
            'contact_email' => $contact_email,
        ]);
    }
}
