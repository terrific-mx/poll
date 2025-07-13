<?php

use Livewire\Volt\Component;


use App\Models\Poll;
use App\Models\Answer;
use App\Models\Response;
use Illuminate\Support\Facades\Redirect;

new class extends Component {
    public Poll $poll;
    public $answer_id = null;
    public $contact_email = null;

    public function submit()
    {
        $validated = $this->validate([
            'answer_id' => 'required|exists:answers,id',
            'contact_email' => ['nullable', 'email'],
        ]);

        $answer = Answer::find($this->answer_id);

        $this->poll->responses()->create([
            'answer_id' => $answer->id,
            'contact_email' => $this->contact_email,
        ]);

        return Redirect::route('polls.public.thankyou', $this->poll->id);
    }
}; ?>

<div>
    <form wire:submit.prevent="submit">
        <div>
            <label for="answer_id">Select an answer:</label>
            <select wire:model="answer_id" id="answer_id" required>
                <option value="">-- Choose --</option>
                @foreach ($poll->answers as $answer)
                    <option value="{{ $answer->id }}">{{ $answer->text }}</option>
                @endforeach
            </select>
            @error('answer_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="contact_email">Contact Email (optional):</label>
            <input type="email" wire:model="contact_email" id="contact_email" />
            @error('contact_email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
