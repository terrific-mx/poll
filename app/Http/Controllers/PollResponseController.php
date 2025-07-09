<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use Illuminate\Support\Facades\DB;

class PollResponseController extends Controller
{
    public function store(Request $request, Poll $poll)
    {
        $validated = $request->validate([
            'answer_id' => ['required', 'exists:answers,id'],
        ]);

        // Store the response
        DB::table('responses')->insert([
            'poll_id' => $poll->id,
            'answer_id' => $validated['answer_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back();
    }
}
