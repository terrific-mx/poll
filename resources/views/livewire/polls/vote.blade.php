<?php

use App\Models\Answer;
use App\Models\Poll;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Volt\Component;

new #[Layout('components.layouts.poll')] class extends Component {
    public Poll $poll;
    public ?Collection $answers;
    public $showThankYouMessage = false;

    public $answer;

    #[Url('c')]
    public $contact = null;

    public function rendering(View $view)
    {
        $view->title($this->poll->question);
    }

    public function mount()
    {
        $this->answers = $this->poll->answers;
    }

    public function vote()
    {
        $this->poll->addResponse(
            Answer::find($this->answer), $this->contact
        );

        $this->showThankYouMessage = true;
    }
}; ?>

<div>
    @unless($showThankYouMessage)
        <form wire:submit="vote" class="space-y-4">
            <flux:radio.group wire:model="answer" :label="$poll->question">
                @foreach($answers as $answer)
                    <flux:radio :value="$answer->id" :label="$answer->text" />
                @endforeach
            </flux:radio.group>

            <flux:input wire:model="contact" label="Email" class="max-w-sm" />

            <flux:button type="submit" variant="primary" class="mt-6">Submit response</flux:button>
        </form>
    @else
        <div>
            <h1>Thank you for your response.</h1>
        </div>
    @endunless
</div>
