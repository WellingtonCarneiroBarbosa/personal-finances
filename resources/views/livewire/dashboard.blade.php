    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Personal Finances Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                You've spent: {{ $content['expenses'] }}
                <br>
                You've received: {{ $content['incomes'] }}
                <br>
                Your current balance is: {{ $content['balance'] }}
            </x-partials.card>
        </div>
    </div>
