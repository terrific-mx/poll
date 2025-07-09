<x-layouts.auth>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-2">{{ $poll->name }}</h1>
        <p class="mb-4 text-gray-700">{{ $poll->question }}</p>

        @if($poll->answers && $poll->answers->count())
            <form method="POST" action="{{ url('/p/' . $poll->id) }}">
                @csrf
                <div class="mb-4">
                    @foreach($poll->answers as $answer)
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="answer_id" value="{{ $answer->id }}" class="form-radio" required>
                                <span class="ml-2">{{ $answer->text }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
            </form>
        @else
            <p class="text-gray-500">No answers available for this poll.</p>
        @endif
    </div>
</x-layouts.auth>
