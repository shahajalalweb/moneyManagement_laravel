<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BudgetController extends Controller
{

    // api check route in api.php
    public function apiCheck()
    {
        $budgetUserID = Auth::user()->id;
        $budgetData = Budget::where('user_id', $budgetUserID)->get();
        return response()->json($budgetData, 200);
    }

    public function index()
    {
        $budgetUserID = Auth::user()->id;

        $budgetData = Budget::where('user_id', $budgetUserID)
            ->orderBy('id', 'DESC')
            ->paginate(3);

        return view("budget", compact("budgetData"));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'month' => 'required',
            'budget' => 'required|numeric|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors(['error' => 'Please fill all required fields correctly.'])
                ->withInput();
        }

        // $budgetUserID = Auth::user()->id;

        // $data = new Budget();
        // $data->user_id = $budgetUserID;
        // $data->month = $request->month;
        // $data->budget = $request->budget;
        // $data->save();

        // return redirect()->route("budget")->with('success', 'Budget created successfully');


        // different way to save data
        $user = Auth::user();
        // $user->load('budgets');
        $data = [
            'month' => $request->month,
            'budget' => $request->budget,
        ];
        $user->budgets()->create($data);
        return redirect()->route("budget")->with('success', 'Budget created successfully');
    }

    public function edit(string $id)
    {
        $budgetUserID = Auth::user()->id;
        $budgetData = Budget::where('user_id', $budgetUserID)
            ->orderBy('id', 'DESC')
            ->paginate(3);
        $editBudget = Budget::findOrFail($id);
        return view("budget", compact("budgetData", "editBudget"));
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'month' => 'required',
            'budget' => 'required|numeric|min:1',
        ]);

        $data = Budget::find($id);
        $data->month = $request->month;
        $data->budget = $request->budget;

        $data->save();
        return redirect()->route("budget")->with('success', 'Budget updated successfully');
    }

    public function destroy(string $id)
    {
        $budgetDel = Budget::find($id);
        $budgetDel->delete();
        return redirect()->route("budget")->with('success', 'Budget deleted successfully');
    }
}
