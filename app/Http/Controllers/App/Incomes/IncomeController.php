<?php

namespace App\Http\Controllers\App\Incomes;

use App\Actions\Application\Incomes\CreateNewIncome;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Models\Income\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Income::class);

        return view('app.incomes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIncomeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomeRequest $request)
    {
        $this->authorize('create', Income::class);

        $income = CreateNewIncome::run($request->validated());

        return redirect()
            ->route('incomes.edit', $income)
            ->withSuccess(__('Income registered'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        $this->authorize('view', $income);

        return view('app.incomes.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        $this->authorize('update', $income);

        return view('app.incomes.edit', compact('income'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomeRequest  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomeRequest $request, Income $income)
    {
        $this->authorize('update', $income);

        $income->fill($request->validated())->update();

        return redirect()
            ->route('incomes.edit', $income)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        $this->authorize('delete', $income);

        $income->delete();

        return redirect()
            ->route('incomes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
