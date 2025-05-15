<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Budget; // Ensure this class exists in the specified namespace
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OverviewController extends Controller
{

    public function index()
    {
        
// SELECT USER ID
$userID = Auth::user()->id;

// THIS MONTH BUDGET & COST
$BudgetThisMonth = Budget::whereMonth('created_at', date('m'))
    ->whereYear('created_at', date('Y'))
    ->where('user_id', $userID)
    ->sum('budget');

$totalCostThisMonth = Cost::whereMonth('created_at', date('m'))
    ->whereYear('created_at', date('Y'))
    ->where('user_id', $userID)
    ->sum('cost');

$thisMonthAvailable = $BudgetThisMonth - $totalCostThisMonth;

// LAST MONTH BUDGET & COST
$BudgetLastMonth = Budget::whereMonth('created_at', date('m', strtotime('-1 month')))
    ->whereYear('created_at', date('Y', strtotime('-1 month')))
    ->where('user_id', $userID)
    ->sum('budget');

$totalCostLastMonth = Cost::whereMonth('created_at', date('m', strtotime('-1 month')))
    ->whereYear('created_at', date('Y', strtotime('-1 month')))
    ->where('user_id', $userID)
    ->sum('cost');

$lastMonthAvailable = $BudgetLastMonth - $totalCostLastMonth;

// TOTAL BUDGET & COST
$totalBudget = Budget::where('user_id', $userID)->sum('budget');
$totalCost = Cost::where('user_id', $userID)->sum('cost');
$totalAvailable = $totalBudget - $totalCost;



        // Group data for looping
        $reports = [
            [
                'title' => 'This Month\'s Report',
                'datas' => [
                    [
                        'title' => 'Budget',
                        'value' => $BudgetThisMonth,
                        'icons'=> '<i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>',
                    ],
                    [
                        'title' => 'Cost',
                        'value'  => $totalCostThisMonth,
                        'icons'=> '<i class="ni ni-credit-card text-lg relative top-3.5 text-white"></i>',
                    ],
                    [
                        'title' => 'Available',
                        'value' => $thisMonthAvailable,
                        'icons'=> '<i class="ni ni-world text-lg relative top-3.5 text-white"></i>',
                    ]
                ]
            ],
            [
                'title' => 'Last Month\'s Report',
                'datas' => [
                    [
                        'title' => 'Last Month Budget',
                        'value' => $BudgetLastMonth,
                        'icons'=> '<i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>',
                    ],
                    [
                        'title' => 'Last Month Cost',
                        'value'  => $totalCostLastMonth,
                        'icons'=> '<i class="ni ni-credit-card text-lg relative top-3.5 text-white"></i>',
                    ],
                    [
                        'title' => 'Last Month Available',
                        'value' => $lastMonthAvailable,
                        'icons'=> '<i class="ni ni-world text-lg relative top-3.5 text-white"></i>',
                    ]
                ]
            ],
            [
                'title' => 'Total Report',
                'datas' => [
                    [
                        'title' => 'Total Budget',
                        'value' => $totalBudget,
                        'icons'=> '<i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>',
                    ],
                    [
                        'title' => 'Total Cost',
                        'value'  => $totalCost,
                        'icons'=> '<i class="ni ni-credit-card text-lg relative top-3.5 text-white"></i>',
                    ],
                    [
                        'title' => 'Total Available',
                        'value' => $totalAvailable,
                        'icons'=> '<i class="ni ni-world text-lg relative top-3.5 text-white"></i>',
                    ]
                ]
            ]
        ];


        return view('dashboard', compact('reports',));
    }
}
