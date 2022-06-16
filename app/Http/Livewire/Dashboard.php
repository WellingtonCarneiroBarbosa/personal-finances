<?php

namespace App\Http\Livewire;

use App\Models\Expense\Expense;
use App\Models\Income\Income;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public array $content = [
        'expenses' => 'R$ 0,00',
        'incomes'  => 'R$ 0,00',
        'balance'  => 'R$ 0,00',
        'from'     => '01/01/2022',
        'to'       => '02/01/2022',
    ];

    protected $totalExpenses;

    protected $totalIncomes;

    protected $balance;

    protected $from;

    protected $to;

    public function mount()
    {
        $this->initializeFromAndTo();

        $this->setTotalExpenses();
        $this->setTotalIncomes();
        $this->setBalance($this->totalExpenses, $this->totalIncomes);

        $this->setContent();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

    protected function initializeFromAndTo()
    {
        $this->from = now()->subMonth()->format('Y-m-d');
        $this->to   = now()->format('Y-m-d');
    }

    protected function setContent()
    {
        $expenses = currency($this->totalExpenses, auth()->user())->toReadable();
        $incomes  = currency($this->totalIncomes, auth()->user())->toReadable();
        $balance  = $this->balance;

        $this->content         = compact('expenses', 'incomes', 'balance');
        $this->content['from'] = Carbon::parse($this->from)->format('m/d/Y');
        $this->content['to']   = Carbon::parse($this->to)->format('m/d/Y');
    }

    protected function setBalance(float $costs, float $incomes): void
    {
        $this->balance = $incomes - $costs;
    }

    protected function setTotalIncomes(): void
    {
        $this->totalIncomes = (float)Income::whereBetween('date', [$this->from, $this->to])->sum('amount');
    }

    protected function setTotalExpenses(): void
    {
        $this->totalExpenses = (float)Expense::whereBetween('date', [$this->from, $this->to])->sum('cost');
    }
}
