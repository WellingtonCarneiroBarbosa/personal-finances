@php $editing = isset($expense) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text name="title" label="Title" value="{{ old('title', $editing ? $expense->title : '') }}"
            maxlength="255" placeholder="Title" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number name="cost" label="Cost" value="{{ old('cost', $editing ? $expense->cost : '') }}" max="255"
            step="0.01" placeholder="Cost" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="description" label="Description" maxlength="255">
            {{ old('description', $editing ? $expense->description : '') }}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="expense_category_id" :label="__('crud.expenses.inputs.expense_category_id')" required>
            @php $selected = old('expense_category_id', ($editing ? $expense->expense_category_id : '')) @endphp
            @foreach ($expenseCategories as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

</div>
