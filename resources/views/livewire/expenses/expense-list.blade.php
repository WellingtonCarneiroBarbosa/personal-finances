<div class="block w-full overflow-auto scrolling-touch">
    <table class="w-full max-w-full mb-4 bg-transparent">
        <thead class="text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left">
                    @lang('crud.expenses.inputs.title')
                </th>
                <th class="px-4 py-3 text-right">
                    @lang('crud.expenses.inputs.cost')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('crud.expenses.inputs.description')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('crud.expenses.inputs.date')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('crud.expenses.inputs.expense_category_id')
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @forelse ($expenses as $expense)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-left">
                        {{ $expense['title'] ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $expense['cost'] ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $expense['description'] ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        @php
                            if ($expense['date']) {
                                $date = \Carbon\Carbon::createFromDate($expense['date'])->format('m/d/Y');
                            }
                        @endphp
                        {{ $date ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $expense['category']['name'] ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-center" style="width: 134px;">
                        <div role="group" aria-label="Row Actions"
                            class="
                        relative
                        inline-flex
                        align-middle
                    ">
                            <a href="{{ route('expenses.edit', $expense['id']) }}" class="mr-1">
                                <button type="button" class="button">
                                    <i class="icon ion-md-create"></i>
                                </button>
                            </a>
                            <a href="{{ route('expenses.show', $expense['id']) }}" class="mr-1">
                                <button type="button" class="button">
                                    <i class="icon ion-md-eye"></i>
                                </button>
                            </a>
                            <form action="{{ route('expenses.destroy', $expense['id']) }}" method="POST"
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

            @if ($hasMorePages)
                @include('components.infinite-scrolling-script', ['method' => 'loadMoreExpenses'])
            @endif
        </tbody>

        @if ($hasMorePages)
            <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="mt-10 px-4 float-right">
                            <button wire:click.prevent="loadMoreExpenses()">Load more expenses</button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        @endif
    </table>
</div>
