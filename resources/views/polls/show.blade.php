<x-layouts.poll :title="$poll->question">
    <div class="p-4 max-w-full md:p-6 md:max-w-sm mx-auto">
        {{-- Poll question --}}
        <flux:heading size="lg">{{ $poll->question }}</flux:heading>

        @if($poll->answers && $poll->answers->count())
            <form action="{{ route('polls.public.store', $poll->id) }}" method="POST" class="mt-8">
                @csrf
                <div>
                    <flux:radio.group required>
                        @foreach($poll->answers as $answer)
                            <flux:radio name="answer_id" :value="$answer->id" :label="$answer->text" />
                        @endforeach
                    </flux:radio.group>
                </div>
                <flux:button type="submit" variant="primary" class="w-full mt-8">Vote now</flux:button>
            </form>
        @else
            <flux:text class="mt-8 text-center">No answers available for this poll.</flux:text>
        @endif

        {{-- Thank you message --}}
        <div class="flex justify-center">
            <flux:icon.check-circle variant="solid" class="text-green-500 size-12" />
        </div>
        <flux:heading size="lg" class="mt-6 text-center">Thank you for participating!</flux:heading>
        <flux:text class="mt-1 text-center">Thanks for taking part in our poll. You may now close this window.</flux:text>
    </div>
</x-layouts.poll>
