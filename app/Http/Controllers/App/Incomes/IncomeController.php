<?php

namespace App\Http\Controllers\App\Incomes;

use App\Actions\Application\Incomes\CreateNewIncome;
use App\Actions\Application\Incomes\DeleteIncome;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Models\Income\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view-any', Expense::class);

        $search = $request->get('search', '');

        $incomes = Income::search($search)
                ->orderBy('date', 'desc')
                ->paginate(5)
                ->withQueryString();

        return view('app.incomes.index', compact('incomes', 'search'));
    }

    public function create()
    {
        $this->authorize('create', Income::class);

        return view('app.incomes.create');
    }

    public function store(StoreIncomeRequest $request)
    {
        $this->authorize('create', Income::class);

        $income = CreateNewIncome::run($request->validated());

        return redirect()
            ->route('incomes.edit', $income)
            ->withSuccess(__('Income registered'));
    }

    public function show(Income $income)
    {
        $this->authorize('view', $income);

        return view('app.incomes.show', compact('income'));
    }

    public function edit(Income $income)
    {
        $this->authorize('update', $income);

        return view('app.incomes.edit', compact('income'));
    }

    public function update(UpdateIncomeRequest $request, Income $income)
    {
        $this->authorize('update', $income);

        $income->fill($request->validated())->update();

        return redirect()
            ->route('incomes.edit', $income)
            ->withSuccess(__('crud.common.saved'));
    }

    public function destroy(Income $income)
    {
        $this->authorize('delete', $income);

        DeleteIncome::run($income);

        return redirect()
            ->route('incomes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
