<?php

namespace App\Http\Controllers;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $currentDate = $request->session()->get('current_date', now());
        $years =  date('Y', strtotime($currentDate));
        $user_id = Auth::id();
        // $action = 0; // 0 - income, 1 - expenses
        $budget = Budget::query()
            ->whereYear('inputDate', $years)
            ->where('user_id', $user_id)
            ->get();
        $income = $budget->where('action', 0)->sum('amount');
        $expense = $budget->where('action', 1)->sum('amount');
        $total = $income - $expense;
        return view('report.index',[
            'years' => $years,
            'income' => $income,
            'expense' => $expense,
            'total' => $total

        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
