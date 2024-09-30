<?php

namespace App\Http\Controllers;

use App\Models\BudgetModel;
use App\Models\CostModel;
use Illuminate\Http\Request;

class OverviewController extends Controller
{

    public function index()
    {
        // THIS MONTH BUDGET SELECT 
        $BudgetThisMonth = BudgetModel::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('budget');
        $totalCostThisMonth = CostModel::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('cost');
        $thisMonthAvailable = $BudgetThisMonth - $totalCostThisMonth;

        // LAST MONTH BUDGET SELECT
        $BudgetLastMonth = BudgetModel::whereMonth('created_at', date('m', strtotime('-1 month')))
            ->whereYear('created_at', date('Y', strtotime('-1 month')))
            ->sum('budget');
        $totalCostLastMonth = CostModel::whereMonth('created_at', date('m', strtotime('-1 month')))
            ->whereYear('created_at', date('Y', strtotime('-1 month')))
            ->sum('cost');
        $lastMonthAvailable = $BudgetLastMonth - $totalCostLastMonth;

        // Group data for looping
        $reports = [
            [
                'title' => 'This Month\'s Report',
                'datas' => [
                    [
                        'title'=> 'Budget',
                        'value'=> $BudgetThisMonth,
                    ],
                    [
                        'title' => 'Cost',
                        'value'  => $totalCostThisMonth,
                    ],
                    [
                        'title'=> 'Available',
                        'value' => $thisMonthAvailable,
                    ]
                ]
            ],
            [
                'title' => 'Last Month\'s Report',  
                'datas' => [
                    [
                        'title'=> 'Last Month Budget',
                        'value'=> $BudgetLastMonth,
                    ],
                    [
                        'title' => 'Last Month Cost',
                        'value'  => $totalCostLastMonth,
                    ],
                    [
                        'title'=> 'Last Month Available',
                        'value' => $lastMonthAvailable,
                    ]
                ]
            ]
        ];


        return view('dashboard', compact('reports',));
    }
}
