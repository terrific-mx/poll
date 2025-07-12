<?php

namespace App\Http\Controllers;

use App\Models\Poll;

class ThankYouController extends Controller
{
    public function show(Poll $poll)
    {
        return view('polls.thank-you', compact('poll'));
    }
}
