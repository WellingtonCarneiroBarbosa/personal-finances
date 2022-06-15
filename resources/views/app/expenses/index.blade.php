<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.expenses.index_title')
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
                            @can('create', App\Models\Expense::class)
                                <a href="{{ route('expenses.create') }}" class="button button-primary">
                                    <i class="mr-1 icon ion-md-add"></i>
                                    {{ __('Register') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <livewire:expenses.expense-list />
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
