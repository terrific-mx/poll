
<?php
use App\Models\Poll;
use Livewire\Volt\Component;
new class extends Component {
    public Poll $poll;
}; ?>

<div class="mx-auto max-w-4xl">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('polls.index')" wire:navigate>Polls</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $poll->name }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <!-- Header -->
    <div class="mt-4 flex flex-wrap items-end justify-between gap-4">
        <div class="max-sm:w-full sm:flex-1">
            <flux:heading size="xl" level="1">{{ $poll->question }}</flux:heading>
        </div>
        <flux:button href="{{ route('polls.respond', $poll) }}" variant="primary">View</flux:button>
    </div>

    <!-- Summary grid -->
    <div class="mt-8 grid gap-8 sm:grid-cols-2">
        <div>
            <flux:separator variant="subtle" />
            <flux:heading class="mt-6">Total responses</flux:heading>
            <div class="mt-3 text-3xl font-semibold sm:text-2xl">
                {{ $poll->answers->sum('responsesCount') }}
            </div>
        </div>
        <div>
            <flux:separator variant="subtle" />
            <flux:heading class="mt-6">Number of answers</flux:heading>
            <div class="mt-3 text-3xl font-semibold sm:text-2xl">
                {{ $poll->answers->count() }}
            </div>
        </div>
    </div>

    <!-- Answers table -->
    <flux:heading level="2" class="mt-12">Responses received</flux:heading>

    <div class="flow-root">
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-left text-sm text-zinc-950 dark:text-white">
                <thead class="text-zinc-500 dark:text-zinc-400">
                    <tr>
                        <th class="border-b border-b-zinc-950/10 px-2 py-2 font-medium dark:border-b-white/10">Answer</th>
                        <th class="border-b border-b-zinc-950/10 px-2 py-2 font-medium dark:border-b-white/10">Responses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($poll->answers as $answer)
                        <tr>
                            <td class="px-2 py-3 border-b border-zinc-950/5 dark:border-white/5">{{ $answer->text }}</td>
                            <td class="px-2 py-3 border-b border-zinc-950/5 dark:border-white/5">{{ $answer->responsesCount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div
        x-data="{
            copied: false,
            copyHtml() {
                const html = this.$refs.answersList.outerHTML;
                console.log(html);
                navigator.clipboard.write([
                    new ClipboardItem({ 'text/html': new Blob([html], { type: 'text/html' }) })
                ]).then(() => {
                    this.copied = true;
                    setTimeout(() => this.copied = false, 1500);
                });
            }
        }"
        class="mt-12"
    >
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div class="max-sm:w-full sm:flex-1">
                <flux:heading level="2">Poll preview</flux:heading>
            </div>
            <flux:button @click="copyHtml" x-text="copied ? 'Copied!' : 'Copy for Email'" size="sm" class="-my-1">Copy for email</flux:button>
        </div>

        <ul class="space-y-3 mt-6 list-disc ml-6 text-sm" x-ref="answersList">
            @foreach($poll->answers as $answer)
                <li>
                    <a href="{{ route('polls.respond', ['poll' => $poll, 'a' => $answer->id]) }}" class="underline">{{ $answer->text }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
