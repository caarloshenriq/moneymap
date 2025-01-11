<x-app-layout>
    <form method="POST" action="{{ route('balance.store') }}">
        @csrf()

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Ops! Algo deu errado.</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 text-center text-xl">
                        {{ __("Nova Entrada ou Saída") }}
                    </div>

                    <div class="mt-6">
                        <x-input-label for="name" :value="__('Nome do Registro')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="flex flex-col lg:flex-row gap-4 mt-4">
                        <div class="w-full">
                            <x-input-label for="value" :value="__('Valor do Registro')" />
                            <x-text-input id="value" class="block mt-1 w-full" type="number" step="0.01" name="amount" :value="old('amount')" required autofocus />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <div class="w-full">
                            <x-input-label for="type" :value="__('Tipo de Registro (Entrada ou Saída)')" />
                            <select id="type" name="type" class="block mt-1 w-full" required onchange="togglePlaceField()">
                                <option value="" disabled selected>Selecione</option>
                                <option value="P">Entrada</option>
                                <option value="E">Saída</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-4 mt-4">
                        <div class="w-full">
                            <x-input-label for="date" :value="__('Data do Registro (Padrão: Hoje)')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <div id="placeField" class="w-full hidden">
                            <x-input-label for="place" :value="__('Local de Gasto')" />
                            <x-text-input id="place" class="block mt-1 w-full" type="text" name="place" :value="old('place')" />
                            <x-input-error :messages="$errors->get('place')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Registrar') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function togglePlaceField() {
            const type = document.getElementById('type').value;
            const placeField = document.getElementById('placeField');
            if (type === 'E') {
                placeField.classList.remove('hidden');
            } else {
                placeField.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>