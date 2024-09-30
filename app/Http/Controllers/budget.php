<?php

namespace App\Http\Controllers;

use App\Models\BudgetModel;
use Illuminate\Http\Request;


class budget extends Controller
{
    public function index()
    {
        $budgetData = BudgetModel::orderBy('id', 'desc')->get();
        return view("budget", compact("budgetData"));
    }

    public function create() {}

    public function store(Request $request)
    {
        $data = new BudgetModel();  // Ensure 'Budget' is correctly named
        $data->month = $request->month;
        $data->budget = $request->budget;
        $data->save();
        return redirect()->route("budget");
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $editBudget = BudgetModel::findOrFail($id);
        $budgetData = BudgetModel::orderBy('id', 'desc')->get();
        return view("budget", compact("budgetData", "editBudget"));
    }

    public function update(Request $request, string $id) {
        $data = BudgetModel::find($id);
        $data->month = $request->month;
        $data->budget = $request->budget;
        
        $data->save();
        return redirect()->route("budget");
    }

    public function destroy(string $id)
    {
        $budgetDel = BudgetModel::find($id);
        $budgetDel->delete();
        return redirect()->route("budget");
        
    }
}
