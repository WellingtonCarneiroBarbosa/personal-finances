<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Application Settings') }}
    </h2>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-jet-form-section submit="updateSettings">
            <x-slot name="title">
                {{ __('Your current settings') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Update your account settings.') }}
            </x-slot>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="timezone" value="{{ __('Timezone') }}" />
                    <x-jet-input id="timezone" type="text" class="mt-1 block w-full" wire:model.defer="settings.timezone"
                        autocomplete="timezone" />
                    <x-jet-input-error for="timezone" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="locale" value="{{ __('Country') }} / {{ __('Region') }}" />
                    <x-jet-input id="locale" type="text" class="mt-1 block w-full" wire:model.defer="settings.locale"
                        autocomplete="locale" />
                    <x-jet-input-error for="locale" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('Saved.') }}
                </x-jet-action-message>

                <x-jet-button wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>


        <x-jet-section-border />
    </div>
</div>
