<?php

namespace App\Http\Controllers;

use App\Models\CostCategory;
use Illuminate\Http\Request;

class CostCategoryController extends Controller
{
    
    public function index() {
        // Fetch all cost categories for the authenticated user
        $costCategories = auth()->user()->costCategories;

        // Return the view with the cost categories
        return view('costCategory', compact('costCategories'));
    }

    public function store(Request $request) {
        $userID = auth()->user()->id;
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new cost category
        $costCategory = new CostCategory();
        $costCategory->name = $request->name;
        $costCategory->user_id = $userID;
        $costCategory->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Cost category created successfully.');
    }

    public function destroy($id) {
        // Find the cost category by ID
        $costCategory = CostCategory::findOrFail($id);

        // Delete the cost category
        $costCategory->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Cost category deleted successfully.');
    }
}
