<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-gray-900 text-xl font-bold">
                        {{ __("Minhas Entradas e Saídas") }}
                    </h2>
                    <a href="{{ route('balance.create') }}"
                        class="bg-primary-color hover:bg-second-color text-white font-bold py-2 px-4 rounded">
                        {{ __("Novo") }}
                    </a>
                </div>
                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __("Nome") }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __("Valor") }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __("Tipo") }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __("Data") }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __("Local") }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($balances as $balance)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $balance->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $balance->amount }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $balance->type == 'P' ? 'Entrada' : 'Saída' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($balance->date)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $balance->place }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    {{ __("Nenhum registro encontrado") }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $balances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>