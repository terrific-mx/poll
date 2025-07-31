<?php

use App\Models\Poll;
use Livewire\Volt\Component;

new class extends Component {
    public Poll $poll;
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
                <li><a href="#" class="underline">{{ $option->label }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
