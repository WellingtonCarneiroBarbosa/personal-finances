@php $editing = isset($income) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text name="title" label="Title" value="{{ old('title', $editing ? $income->title : '') }}"
            maxlength="255" placeholder="Title" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="amount" label="Amount"
            value="{{ old('amount', currency($editing ? $income['amount'] : 0, auth()->user())->toReadable()) }}"
            step="0.01" placeholder="amount" required>
            </x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="description" label="Description" maxlength="255">
            {{ old('description', $editing ? $income->description : '') }}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date name="date" label="Date"
            value="{{ old('date', $editing ? $income->date->format('Y-m-d') : now()->format('Y-m-d')) }}" />
    </x-inputs.group>

</div>
