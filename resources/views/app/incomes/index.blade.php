<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.incomes.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text name="search" value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}" autocomplete="off">
                                    </x-inputs.text>

                                    <div class="ml-1">
                                        <button type="submit" class="button button-primary">
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Income\Income::class)
                                <a href="{{ route('incomes.create') }}" class="button button-primary">
                                    <i class="mr-1 icon ion-md-add"></i>
                                    {{ __('Register') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>


                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.incomes.inputs.title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.incomes.inputs.amount')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.incomes.inputs.description')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.incomes.inputs.date')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse ($incomes as $income)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-left">
                                        {{ $income['title'] ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left w-48">
                                        {{ currency($income['amount'] ?? 0, auth()->user())->toReadable() }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $income['description'] ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        @php
                                            if ($income['date']) {
                                                $date = \Carbon\Carbon::createFromDate($income['date'])->format('m/d/Y');
                                            }
                                        @endphp
                                        {{ $date ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions"
                                            class="
                                        relative
                                        inline-flex
                                        align-middle
                                    ">
                                            <a href="{{ route('incomes.edit', $income['id']) }}"
                                                class="mr-1">
                                                <button type="button" class="button">
                                                    <i class="icon ion-md-create"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('incomes.show', $income['id']) }}"
                                                class="mr-1">
                                                <button type="button" class="button">
                                                    <i class="icon ion-md-eye"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('incomes.destroy', $income['id']) }}"
                                                method="POST"
                                                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="button">
                                                    <i
                                                        class="
                                                    icon
                                                    ion-md-trash
                                                    text-red-600
                                                "></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
