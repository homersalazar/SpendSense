<?php

namespace App\Http\Controllers;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IncomeController extends Controller
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
        $action = 0; // 0 - income, 1 - expenses
        $budgetQuery = Budget::query()
            ->whereYear('inputDate', $years)
            ->where('user_id', $user_id)
            ->where('action', $action);
        $budget = $budgetQuery->get();
        $income = $budget->sum('amount');

        $monthlyTotals = [];
        $currentMonth = date('n');
        for ($i = 1; $i <= $currentMonth; $i++) {
            $monthlyQuery = clone $budgetQuery; // Create a new instance of the query builder
            $total = $monthlyQuery->whereMonth('inputDate', $i)->sum('amount');
            $monthlyTotals[$i] = $total;
        }

        return view('income.index',[
            'years' => $years,
            'total' => $total,
            'income' => $income,
            'monthlyTotals' => $monthlyTotals
        ]);
    }

    public function decrement(Request $request)
    {
        $currentDate = Carbon::parse($request->session()->get('current_date', now()));
        $currentDate->subYear(); // Decrement the year by 1
        $request->session()->put('current_date', $currentDate);
        return redirect()->back();
    }

    public function increment(Request $request)
    {
        $currentDate = Carbon::parse($request->session()->get('current_date', now()));
        $currentDate->addYear(); // Increment the year by 1
        $request->session()->put('current_date', $currentDate);
        return redirect()->back();
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
        $this->validate($request,[
            'details' => 'required',
            'price' => ['numeric', 'between:0,9999.99'],
        ]);
        $income = new Budget;
        $income->user_id = Auth::id(); // employee id
        $income->action = 0; // 0 - income, 1 - expenses
        $income->details = $request->details;
        $income->amount = floatval(str_replace(',', '', $request->amount));
        $income->inputDate = $request->input_date;
        $income->save();
        return response()->json(['success' => ucwords($request->details) . ' has been added successfully.']);

        // return redirect()->route('income.view')->with('success',' '.ucwords($request->details).' has been added successfully.');

    }
    public function view(Request $request)
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
        $user_id = Auth::id();
        $action = 0; // 0 - income, 1 - expenses
        $budgetQuery = Budget::whereYear('inputDate', $year)
            ->whereMonth('inputDate', $month)
            ->where('user_id', $user_id)
            ->where('action', $action);
        $income = $budgetQuery->sum('amount');

        $selectedDate = $request->session()->get('selectedDate');
        $totals = [];
        for ($i = 1; $i <= $selectedDate; $i++) {
            $date = Carbon::createFromDate($year, $month, $i)->format('Y-m-d');
            $total = Budget::where('user_id', $user_id)
                ->where('action', $action)
                ->whereDate('inputDate', $date)
                ->sum('amount');

            $totals[$i] = $total;
        }
        return view('income.view', [
            'year' => $year,
            'month' => $month,
            'daysInMonth' => $daysInMonth,
            'matchMonth' => $matchMonth,
            'totals' => $totals,
            'income' => $income
        ]);
    }

    public function add(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');
        $date = $request->input('date');
        $day = $request->input('day');
        $monthNames = [
            'January' => 1,
            'February' => 2,
            'March' => 3,
            'April' => 4,
            'May' => 5,
            'June' => 6,
            'July' => 7,
            'August' => 8,
            'September' => 9,
            'October' => 10,
            'November' => 11,
            'December' => 12
        ];
        $matchedMonth = array_search($month, $monthNames);
        $displayDate = implode(' ', [$matchedMonth, $date. ',', $year]);
        $dateInput = implode('-', [$year, $month, $date]);
        $user_id = Auth::id();
        $action = 0;
        $table = Budget::where('inputDate', $dateInput)
            ->where('user_id', $user_id)
            ->where('action', $action)
            ->get();
        $item = $table->count();
        $total = $table->sum('amount');
        return view('income.create',[
            'displayDate' => $displayDate,
            'day' => $day,
            'item' => $item,
            'total' => $total,
            'table' => $table,
            'dateInput' => $dateInput
        ]);
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

