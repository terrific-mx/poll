<?php

use Livewire\Volt\Component;
use App\Models\Answer;
use App\Models\Poll;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

new #[Layout('components.layouts.poll')] class extends Component {
    public Poll $poll;

    #[Url('a')]
    public $answer_id;

    #[Url('c')]
    public $contact_email;

    public $showThankYou = false;

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

        $this->showThankYou = true;
    }
}; ?>

<div class="max-w-sm mx-auto py-6 lg:p-10">
    @if ($showThankYou)
        <p>Thank you for your response</p>
    @else
        <form wire:submit="submit" class="space-y-8">
            <flux:radio.group wire:model="answer_id" :label="$poll->question">
                @foreach ($poll->answers as $answer)
                    <flux:radio value="{{ $answer->id }}" :label="$answer->text" />
                @endforeach
            </flux:radio.group>

            <div>
                <flux:input
                    type="email"
                    wire:model="contact_email"
                    label="Contact Email (optional)"
                    placeholder="you@example.com"
                />
            </div>

            <div>
                <flux:button type="submit">Submit</flux:button>
            </div>
        </form>
    @endif
</div>
