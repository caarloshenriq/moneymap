<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBalanceRequest;
use App\Models\Balance;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function index()
    {
        $balances = Balance::where('user_id', Auth::user()->id)->paginate(10);
        return view('balance.index', compact('balances'));
    }

    public function create()
    {
        return view('balance.create');
    }

    public function store(StoreBalanceRequest $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        Balance::create($data);

        return redirect()->route('balance.index');
    }

    public function summary()
    {
        $userId = Auth::id();
        $summary = Balance::getBalanceSummary($userId);
        $chartData = Balance::getBalanceByMonth($userId);

        $summary = $summary->isNotEmpty() ? $summary->first()->toArray() : [
            'expense' => 0,
            'revenue' => 0,
            'balance' => 0
        ];
        

        return view('dashboard', compact('summary', 'chartData'));
    }

}
