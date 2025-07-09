<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Response;
use Illuminate\Http\Request;

class PollResponseController extends Controller
{
    public function store(Request $request, Poll $poll)
    {
        $validated = $request->validate([
            'answer_id' => ['required', 'exists:answers,id'],
        ]);

        // Store the response using Eloquent
        Response::create([
            'poll_id' => $poll->id,
            'answer_id' => $validated['answer_id'],
        ]);

        return redirect()->back();
    }
}
