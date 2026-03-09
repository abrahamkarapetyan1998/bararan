<x-app-layout>
    @props([
        'words' => collect(),
        'editRoute' => 'words.edit',
        'deleteRoute' => 'words.destroy',
    ])
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ադմինիստրատոր
        </h2>
    </x-slot>
    <a
        href="{{ route('words.create') }}"
        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
    >
        + Ստեղծել Բառ
    </a>
    <div class="overflow-x-auto border border-gray-200 rounded-lg bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-600">
            <tr>
                <th class="px-4 py-3">Բառ</th>
                <th class="px-4 py-3">Դարձվածք</th>
                <th class="px-4 py-3 w-40">Գործողություններ</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
            @forelse ($words as $word)
                <tr>
                    <td class="px-4 py-3 font-medium text-gray-900">
                        {{ $word->word }}
                    </td>

                    <td class="px-4 py-3 text-gray-700">
                        {{ $word->description }}
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <a
                                href="{{ route($editRoute, $word) }}"
                                class="inline-flex items-center px-3 py-1.5 rounded-md border border-gray-300 hover:bg-gray-50"
                            >
                                Փոփոխել
                            </a>

                            <form method="POST" action="{{ route($deleteRoute, $word) }}"
                                  onsubmit="return confirm('Delete this word?');">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-3 py-1.5 rounded-md border border-red-300 text-red-700 hover:bg-red-50"
                                >
                                    Ջնջել
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-4 py-6 text-center text-gray-500" colspan="3">
                        Բառեր չեն գտնվել
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
