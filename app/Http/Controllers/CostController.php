<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\CostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Fetch categories
        $costCategories  = CostCategory::where('user_id', $userId)->get();

        // Redirect if no categories found
        if ($costCategories->isEmpty()) {
            return redirect()->route('category')->with('error', 'Please create a cost category first');
        }

        // Fetch cost data
        $costData = Cost::where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->paginate(3);

        return view("cost", compact("costData", "costCategories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'details' => 'required',
            'cost' => 'required|numeric|min:1',
        ]);


        $user = Auth::user();
        $data = [
            'details' => $request->details,
            'cost' => $request->cost,
        ];
        $user->costs()->create($data);
        return redirect()->route("cost")->with('success', 'Cost created successfully');

        // COST DEFFARENT WAY
        // $costUserID = Auth::user()->id;
        // $data = new Cost();
        // $data->user_id = $costUserID;
        // $data->details = $request->details;
        // $data->cost = $request->cost;
        // $data->save();
        // return redirect()->route("cost")->with('success', 'Cost created successfully');
    }

    public function edit(string $id)
    {
        $costUserID = Auth::user()->id;
        // Fetch categories
        $costCategories  = CostCategory::where('user_id', $costUserID)->get();

        if ($costCategories->isEmpty()) {
            return redirect()->route('category')->with('error', 'Please create a cost category first');
        } else {
            $costData = Cost::where('user_id', $costUserID)
                ->orderBy('id', 'DESC')
                ->paginate(3);
            $editCost = Cost::findOrFail($id);

            return view("cost", compact("costData", "editCost", "costCategories"));
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'details' => 'required',
            'cost' => 'required|numeric|min:1',
        ]);

        $data = Cost::find($id);
        $data->details = $request->details;
        $data->cost = $request->cost;

        $data->save();
        return redirect()->route("cost")->with('success', 'Cost updated successfully');
    }

    public function destroy(string $id)
    {
        $costDel = Cost::find($id);
        $costDel->delete();
        return redirect()->route("cost")->with('success', 'Cost deleted successfully');
    }
}
