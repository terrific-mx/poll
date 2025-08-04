<?php

use App\Models\Poll;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;

new class extends Component {
    public Poll $poll;
    public Collection $options;

    public function mount()
    {
        $this->options = $this->poll->options()->withCount('responses')->get();
    }
}; ?>

<div class="max-w-5xl mx-auto" x-data="{
    copied: false,
    copyEmbed() {
        const html = this.$refs.embed.innerHTML;

        if (navigator.clipboard && window.ClipboardItem) {
            const blob = new Blob([html], { type: 'text/html' });
            const item = new ClipboardItem({ 'text/html': blob });

            navigator.clipboard.write([item]).then(() => {
                this.copied = true;
                setTimeout(() => this.copied = false, 1500);
            });
        }
    }
}">
    <div class="flex items-end justify-between gap-4">
        <flux:heading size="xl">{{ $poll->name }}</flux:heading>
        <div class="relative">
            <flux:button variant="primary" @click="copyEmbed" x-text="copied ? '{{ __('Copied!') }}' : '{{ __('Copy embed code') }}'">{{ __('Copy embed code') }}</flux:button>
        </div>
    </div>

    <div class="mt-10" x-ref="embed">
        <div class="font-medium">{{ $poll->question }}</div>
        <ul class="mt-6 text-sm space-y-2 list-disc ml-6">
            @foreach ($poll->options as $option)
                <li><a href="{{ route('polls.vote', ['poll' => $poll, 'option' => $option->id]) }}" class="underline">{{ $option->label }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="mt-10">
        <flux:heading>{{ __('Responses') }}</flux:heading>

        @if($options->count())
            <flux:table class="mt-2">
                <flux:table.columns>
                    <flux:table.column>{{ __('Option') }}</flux:table.column>
                    <flux:table.column>{{ __('Count') }}</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($options as $option)
                        <flux:table.row>
                            <flux:table.cell>{{ $option->label }}</flux:table.cell>
                            <flux:table.cell>{{ $option->responses_count }}</flux:table.cell>
                            <flux:table.cell>
                                <flux:modal.trigger name="show-responses-{{ $option->id }}">
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>
                                </flux:modal.trigger>
                                <flux:modal name="show-responses-{{ $option->id }}" class="md:w-96" variant="flyout">
                                    <div class="space-y-6">
                                        <div>
                                            <flux:heading size="lg">{{ __('Responses for') }} {{ $option->label }}</flux:heading>
                                        </div>
                                        @if($option->responses && $option->responses->count())
                                            <flux:table>
                                                <flux:table.columns>
                                                    <flux:table.column>{{ __('Email') }}</flux:table.column>
                                                    <flux:table.column>{{ __('Date') }}</flux:table.column>
                                                </flux:table.columns>
                                                <flux:table.rows>
                                                    @foreach($option->responses as $response)
                                                        <flux:table.row :key="$response->id">
                                                            <flux:table.cell>{{ $response->contact_email ?? __('Anonymous') }}</flux:table.cell>
                                                            <flux:table.cell>{{ $response->created_at->format('Y-m-d') }}</flux:table.cell>
                                                        </flux:table.row>
                                                    @endforeach
                                                </flux:table.rows>
                                            </flux:table>
                                        @else
                                            <flux:text>{{ __('No responses for this option yet.') }}</flux:text>
                                        @endif
                                    </div>
                                </flux:modal>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
        @else
            <flux:text>{{ __('No responses yet.') }}</flux:text>
        @endif
    </div>
</div>
