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
        $currentMonth = date('n');
        $currentDate = $request->session()->get('current_date', now());
        $years =  date('Y', strtotime($currentDate));
        $user_id = Auth::id();
        $action = 0; // 0 - income, 1 - expenses
        $budget = Budget::whereRaw("YEAR(inputDate) =  $years")
            ->where('user_id', $user_id)
            ->where('action', $action)
            ->get();
        $income = $budget->sum('amount');

        $selectedMonth = $request->session()->get('selectedMonth');
        // $total = Budget::where('user_id', $user_id)
        // ->where('action', $action)
        // ->whereMonth('inputDate', $i)
        // ->whereYear('inputDate', $years)
        // ->sum('amount');
        return view('income.index', compact('years', 'income' , 'currentMonth'));
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
            'amount' => 'required'
        ]);
        $income = new Budget;
        $income->user_id = Auth::id(); // employee id
        $income->action = 0; // 0 - income, 1 - expenses
        $income->details = $request->details;
        $income->amount = $request->amount;
        $income->inputDate = $request->input_date;
        $income->save();

        return redirect()->back()->with('success',' '.ucwords($request->details).' has been added successfully.');
    }
    public function view(Request $request)
    {
        $year = $request->query('year');
        $month = $request->query('month');

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
        foreach($monthNames as $key => $value){
            if($month == $value){
                $matchMonth = $key;
            }
        }
        $user_id = Auth::id();
        $action = 0; // 0 - income, 1 - expenses
        $budget = Budget::whereRaw("YEAR(inputDate) = $year AND MONTH(inputDate) = $month")
            ->where('user_id', $user_id)
            ->where('action', $action)
            ->get();
        $income = $budget->sum('amount');

        $selectedDate = $request->session()->get('selectedDate');
        $totals = [];
        for ($i = 1; $i <= $selectedDate; $i++) {
            $date = sprintf('%04d-%02d-%02d', $year, $month, $i);

            $total = Budget::where('user_id', $user_id)
                ->where('action', $action)
                ->whereDate('inputDate', $date)
                ->sum('amount');

            $totals[$i] = $total;
        }
        return view('income.view',[
            'year' => $year,
            'month' => $month,
            'matchMonth' => $matchMonth,
            'budget' => $budget,
            'totals' => $totals,
            'income' => $income
        ]);
    }

    public function add(Request $request)
    {
        $year = $request->input('year');
        $date = $request->input('date');
        $month = $request->input('month');
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
        foreach($monthNames as $key => $value){
            if($value == $month){
                $matchedMonth = $key;
            }
        }
        $income = implode('-', [$year, $month, $date]);
        $user_id = Auth::id();
        $action = 0;
        $table = Budget::where('inputDate', $income)
            ->where('user_id', $user_id)
            ->where('action', $action)
            ->get();
        $item = $table->count();
        $total = $table->sum('amount');
        return view('income.create',[
            'year' => $year,
            'month' => $month,
            'date' => $date,
            'day' => $day,
            'table' => $table,
            'item' => $item,
            'total' => $total,
            "matchedMonth" => $matchedMonth
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
