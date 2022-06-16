<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.incomes.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('incomes.index') }}" class="mr-4"><i
                            class="mr-1 icon ion-md-arrow-back"></i></a>
                </x-slot>

                <x-form method="PUT" action="{{ route('incomes.update', $income) }}" class="mt-4">
                    @include('app.incomes.form-inputs')

                    <div class="mt-10">
                        <a href="{{ route('incomes.index') }}" class="button">
                            <i
                                class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "></i>
                            @lang('crud.common.back')
                        </a>

                        <a href="{{ route('incomes.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add text-primary"></i>
                            {{ __('Register') }}
                        </a>

                        <button type="submit" class="button button-primary float-right">
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
