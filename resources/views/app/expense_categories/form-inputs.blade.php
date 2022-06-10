@php $editing = isset($expenseCategory) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text name="title" label="Title" value="{{ old('title', $editing ? $expenseCategory->title : '') }}"
            maxlength="255" placeholder="Title" required></x-inputs.text>
    </x-inputs.group>
</div>
