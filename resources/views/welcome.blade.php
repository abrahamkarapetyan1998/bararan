<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
<form method="GET" action="{{ route('search') }}" class="max-w-xl w-full">
    <label for="q" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>

    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 3a6 6 0 104.472 10.03l2.249 2.25a1 1 0 001.414-1.415l-2.25-2.249A6 6 0 009 3zm-4 6a4 4 0 118 0 4 4 0 01-8 0z" clip-rule="evenodd"/>
            </svg>
        </div>

        <input
            id="q"
            name="q"
            type="search"
            placeholder="Որոնել Բառ"
            value="{{ $q ?? '' }}"
            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
        />

        <button
            type="submit"
            class="text-white absolute end-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-4 py-2"
        >
            Որոնել
        </button>
    </div>
</form>

<div class="max-w-xl w-full mt-6 space-y-4">
        @forelse(($words ?? collect()) as $word)
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition">
                <div class="text-xl font-semibold text-gray-900">
                    {{ $word->word }}
                </div>

                <p class="mt-4 text-gray-700 leading-relaxed">
                    {{ $word->description }}
                </p>
            </div>
        @empty
            <div class="p-6 bg-gray-50 border border-gray-200 rounded-lg text-center">
                <div class="text-gray-900 font-semibold">Արդյունքներ չեն գտնվել</div>
                <div class="text-gray-600 text-sm mt-1">Փորձեք ուրիշ բառ.</div>
            </div>
        @endforelse
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
