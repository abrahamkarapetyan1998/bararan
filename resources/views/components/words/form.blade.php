@props([
    'word' => null,
])

@php
    $isEdit = $word && $word->exists;
@endphp

<div class="max-w-2xl mx-auto bg-white border border-gray-200 rounded-lg p-6">
    <h1 class="text-xl font-semibold text-gray-900 mb-6">
        {{ $isEdit ? 'Edit Word' : 'Create Word' }}
    </h1>

    <form
        method="POST"
        action="{{ $isEdit ? route('words.update', $word) : route('words.store') }}"
        class="space-y-6"
    >
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <!-- Word -->
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">
                Word
            </label>
            <input
                type="text"
                name="word"
                value="{{ old('word', $word->word ?? '') }}"
                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required
            >
            @error('word')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">
                Description
            </label>
            <textarea
                name="description"
                rows="4"
                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required
            >{{ old('description', $word->description ?? '') }}</textarea>

            @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex items-center gap-3">
            <button
                type="submit"
                class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
            >
                {{ $isEdit ? 'Update' : 'Create' }}
            </button>

            <a
                href="{{ route('words.index') }}"
                class="px-5 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
