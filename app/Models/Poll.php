<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    /** @use HasFactory<\Database\Factories\PollFactory> */
    use HasFactory;

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function addResponse(Answer $answer, ?string $contact)
    {
        $this->responses()->create([
            'answer_id' => $answer->id,
            'contact' => $contact,
        ]);
    }
}
