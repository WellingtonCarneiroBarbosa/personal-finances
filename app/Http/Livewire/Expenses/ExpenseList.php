<?php

namespace App\Http\Livewire\Expenses;

use App\Http\Livewire\Concerns\WithInfiniteScrolling;
use App\Models\Expense\Expense;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class ExpenseList extends Component
{
    use WithInfiniteScrolling;

    public Collection $expenses;

    public function mount()
    {
        $this->expenses = new Collection();
        $this->loadMoreExpenses();
    }

    public function render()
    {
        return view('livewire.expenses.expense-list');
    }

    public function loadMoreExpenses(): void
    {
        $this->getMoreData($this->expensesQuery(), $this->expenses);
    }

    public function expensesQuery(): Builder
    {
        return Expense::with('category')->orderBy('date', 'desc');
    }
}
