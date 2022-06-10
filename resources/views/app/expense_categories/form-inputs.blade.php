@php $editing = isset($expenseCategory) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            value="{{ old('title', ($editing ? $expenseCategory->title : '')) }}"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="workspace_id" label="Workspace" required>
            @php $selected = old('workspace_id', ($editing ? $expenseCategory->workspace_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Workspace</option>
            @foreach($workspaces as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
