<?php


use Livewire\Attributes\Layout;
use Livewire\Volt\Component;


use App\Models\Poll;
use App\Models\Answer;
use App\Models\Response;
use Illuminate\Support\Facades\Redirect;

new #[Layout('components.layouts.poll')] class extends Component {
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

<div class="p-4 max-w-full md:p-6 md:max-w-sm mx-auto">
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
            <flux:button type="submit" variant="primary" class="w-full mt-8">Vote now</flux:button>
        </form>
    @else
        <flux:text class="mt-8 text-center">No answers available for this poll.</flux:text>
    @endif
</div>
