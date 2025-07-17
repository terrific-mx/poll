<?php

use Livewire\Volt\Component;
use App\Models\Answer;
use App\Models\Poll;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

new #[Layout('components.layouts.poll')] class extends Component {
    public Poll $poll;

    public $answer_id;

    #[Url('c')]
    public $contact_email;

    public function rules() {
        return [
            'answer_id' => 'required|exists:answers,id',
            'contact_email' => 'nullable|email',
        ];
    }

    public function submit() {
        $this->validate();

        $answer = Answer::findOrFail($this->answer_id);

        $this->poll->addResponse($answer, $this->contact_email);
    }
}; ?>

<div>
    <form wire:submit="submit">
        <flux:radio.group wire:model="answer_id" :label="$poll->question">
            @foreach ($poll->answers as $answer)
                <flux:radio value="{{ $answer->id }}" :label="$answer->answer" />
            @endforeach
        </flux:radio.group>

        <div class="mt-4">
            <flux:input
                type="email"
                wire:model="contact_email"
                label="Contact Email (optional)"
                placeholder="you@example.com"
            />
        </div>

        <div class="mt-6">
            <flux:button type="submit">Submit</flux:button>
        </div>
    </form>
</div>
