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
        // Try to use Clipboard API for HTML (rich text)
        if (navigator.clipboard && window.ClipboardItem) {
            const blob = new Blob([html], { type: 'text/html' });
            const item = new ClipboardItem({ 'text/html': blob });
            navigator.clipboard.write([item]).then(() => {
                this.copied = true;
                setTimeout(() => this.copied = false, 1500);
            }).catch(() => {
                // Fallback to plain text if HTML copy fails
                navigator.clipboard.writeText(html).then(() => {
                    this.copied = true;
                    setTimeout(() => this.copied = false, 1500);
                });
            });
        } else {
            // Fallback for older browsers
            navigator.clipboard.writeText(html).then(() => {
                this.copied = true;
                setTimeout(() => this.copied = false, 1500);
            });
        }
    }
}">
    <div class="flex items-end justify-between gap-4">
        <flux:heading size="xl">{{ $poll->name }}</flux:heading>
        <div class="relative">
            <flux:button variant="primary" @click="copyEmbed">{{ __('Copy embed code') }}</flux:button>
            <span x-show="copied" x-transition class="absolute left-0 mt-2 text-xs text-green-600 bg-white border rounded px-2 py-1 shadow">Copied!</span>
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
