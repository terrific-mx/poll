<?php

use App\Models\Poll;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] class extends Component {
    public Poll $poll;

    #[Url]
    #[Validate('required|exists:options,id')]
    public $option = '';

    #[Url]
    #[Validate('nullable|email')]
    public $contact_email = '';

    public $submitted = false;

    public function vote()
    {
        $this->validate();

        $this->poll->responses()->create([
            'option_id' => $this->option,
            'contact_email' => $this->contact_email,
        ]);

        $this->submitted = true;
    }
}; ?>

<div>
    @unless($submitted)
        <form wire:submit="vote" class="max-w-sm mx-auto space-y-6">
            <flux:heading>{{ $poll->question }}</flux:heading>

            <flux:radio.group wire:model="option">
                @foreach ($poll->options as $option)
                    <flux:radio value="{{ $option->id }}" label="{{ $option->label }}" />
                @endforeach
            </flux:radio.group>

            <div>
                <flux:input
                    type="email"
                    wire:model="contact_email"
                    label="{{ __('Your email') }}"
                    badge="{{ __('Optional') }}"
                >
                    <x-slot name="iconTrailing">
                        <flux:button
                            type="button"
                            @click="$wire.contact_email = ''"
                            size="sm" variant="subtle" icon="x-mark" class="-mr-1"
                        />
                    </x-slot>
                </flux:input>
            </div>

            <flux:button type="submit" variant="primary">
                {{ __('Submit') }}
            </flux:button>
        </form>
    @else
        <div class="max-w-sm mx-auto text-center space-y-4">
            <flux:heading size="lg">{{ __('Thank you for voting!') }}</flux:heading>
        </div>
    @endunless
</div>
