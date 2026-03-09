<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Word
        </h2>
    </x-slot>

    <x-words.form :word="$word"/>
</x-app-layout>
