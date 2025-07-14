<?php


use Livewire\Attributes\Layout;
use Livewire\Volt\Component;


use App\Models\Poll;
use App\Models\Answer;
use Illuminate\View\View;
use Livewire\Attributes\Url;

new #[Layout('components.layouts.poll')] class extends Component {
    public Poll $poll;
    public $answer_id = null;

    #[Url('c')]
    public $contact_email = null;
    public $showThankYouMessage = false;

    public function rendering(View $view): void
    {
        $view->title($this->poll->question);
    }

    public function submit()
    {
        $this->validate([
            'answer_id' => 'required|exists:answers,id',
            'contact_email' => ['nullable', 'email'],
        ]);

        $answer = Answer::find($this->answer_id);

        $this->poll->responses()->create([
            'answer_id' => $answer->id,
            'contact_email' => $this->contact_email,
        ]);

        $this->showThankYouMessage = true;
    }
}; ?>

<div class="p-4 max-w-full md:p-6 md:max-w-sm mx-auto">
    @unless($showThankYouMessage)
        <div>
            <flux:heading size="lg">{{ $poll->question }}</flux:heading>
            @if($poll->answers && $poll->answers->count())
                <form wire:submit="submit" class="mt-8">
                    <div>
                        <flux:radio.group wire:model="answer_id" required>
                            @foreach($poll->answers as $answer)
                                <flux:radio :value="$answer->id" :label="$answer->text" />
                            @endforeach
                        </flux:radio.group>
                    </div>
                    <flux:input wire:model="contact_email" :value="$contact_email" type="email" class="mt-4" />
                    <flux:button type="submit" variant="primary" class="w-full mt-8">Vote now</flux:button>
                </form>
            @else
                <flux:text class="mt-8 text-center">No answers available for this poll.</flux:text>
            @endif
        </div>
    @else
        <div id="thank-you-message">
            <div class="flex justify-center">
                <flux:icon.check-circle variant="solid" class="text-green-500 size-12" />
            </div>
            <flux:heading size="lg" class="mt-6 text-center">Thank you for participating!</flux:heading>
            <flux:text class="mt-1 text-center">Thanks for taking part in our poll. You may now close this window.</flux:text>
        </div>
    @endunless
</div>
