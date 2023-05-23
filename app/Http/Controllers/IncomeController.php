<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year = $request->input('year');
        $date = $request->input('date');
        $month = $request->input('month');
        $day = $request->input('day');

        $table = Budget::where('month', $month)
            ->where('year', $year)
            ->where('date', $date)
            ->get();

        $total = Budget::where('month', $month)
        ->where('year', $year)
        ->where('date', $date)
        ->sum('amount');
        return view('income.index', [
            'year' => $year,
            'month' => $month,
            'date' => $date,
            'day' => $day,
            'table' => $table,
            'total' => $total
        ]);
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
        //model mo homer
        $this->validate($request,[
            'details' => 'required',
            'amount' => 'required'
        ]);
        $income = new Budget;
        $income->user_id = Auth::id(); // employee id
        $income->action = 0; // 0 - income, 1 - expenses
        $income->details = $request->details;
        $income->amount = $request->amount;
        $income->month = $request->month;
        $income->date = $request->date;
        $income->year = $request->year;
        $income->save();
        return redirect()->back()->with('success', 'adeed successfully.');
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
