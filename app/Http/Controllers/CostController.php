<?php

namespace App\Http\Controllers;

use App\Models\CostModel;
use Illuminate\Http\Request;


class CostController extends Controller
{
    public function index()
    {
        $costData = CostModel::orderBy('id', 'desc')->get();
        return view('cost', compact('costData'));
    }
    public function create() {}

    public function store(Request $request)
    {
        $data = new CostModel();  // Ensure 'Budget' is correctly named
        $data->details = $request->details;
        $data->cost = $request->cost;
        $data->save();
        return redirect()->route("cost");
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $editCost = CostModel::findOrFail($id);
        $costData = CostModel::orderBy('id', 'desc')->get();
        return view("cost", compact("costData", "editCost"));
    }

    public function update(Request $request, string $id)
    {
        $data = CostModel::find($id);
        $data->details = $request->details;
        $data->cost = $request->cost;

        $data->save();
        return redirect()->route("cost");
    }

    public function destroy(string $id)
    {
        $budgetDel = CostModel::find($id);
        $budgetDel->delete();
        return redirect()->route("cost");
    }
}
