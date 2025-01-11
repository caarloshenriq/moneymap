<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBalanceRequest;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function index()
    {

        $balances = Balance::where('user_id', Auth::user()->id)->get();
        return $balances;
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
        
        return redirect()->route('balance.create');
    }
}
