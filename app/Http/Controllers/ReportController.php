<?php

namespace App\Http\Controllers;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $add = 0; // 0 - income, 1 - expenses
        $minus = 1; // 0 - income, 1 - expenses
        $budgetQuery = Budget::query()
            ->whereYear('inputDate', $years)
            ->where('user_id', $user_id);
        $budget = $budgetQuery->get();
        $income = $budget->where('action', $add)->sum('amount');
        $expense = $budget->where('action', $minus)->sum('amount');
        $total = $income - $expense;

        $monthlyTotals = [];
        $currentMonth = date('n');
        for ($i = 1; $i <= $currentMonth; $i++) {
            $monthlyQuery = clone $budgetQuery;
            $monthly = $monthlyQuery->get();
            $monthlyTotals[$i] = [
                'incomeMonthly' => $monthly->filter(function ($item) use ($add, $i) {
                    return $item->action === $add && Carbon::parse($item->inputDate)->month === $i;
                })->sum('amount'),
                'expenseMonthly' => $monthly->filter(function ($item) use ($minus, $i) {
                    return $item->action === $minus && Carbon::parse($item->inputDate)->month === $i;
                })->sum('amount'),
            ];
        }
        return view('report.index', [
            'years' => $years,
            'income' => $income,
            'expense' => $expense,
            'total' => $total,
            'monthlyTotals' => $monthlyTotals
        ]);
    }
    public function basic(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $monthNames = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        $matchMonth = $monthNames[$month] ?? null;
        return view('report.view');
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
