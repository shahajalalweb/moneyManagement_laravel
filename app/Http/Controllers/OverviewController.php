<?php

namespace App\Http\Controllers;

use App\Models\BudgetModel;
use App\Models\CostModel;
use Illuminate\Http\Request;

class OverviewController extends Controller
{

    public function index()
    {
        // THIS MONTH BUDGET COST SELECT 
        $BudgetThisMonth = BudgetModel::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('budget');
        $totalCostThisMonth = CostModel::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('cost');
        $thisMonthAvailable = $BudgetThisMonth - $totalCostThisMonth;

        // LAST MONTH BUDGET COST SELECT
        $BudgetLastMonth = BudgetModel::whereMonth('created_at', date('m', strtotime('-1 month')))
            ->whereYear('created_at', date('Y', strtotime('-1 month')))
            ->sum('budget');
        $totalCostLastMonth = CostModel::whereMonth('created_at', date('m', strtotime('-1 month')))
            ->whereYear('created_at', date('Y', strtotime('-1 month')))
            ->sum('cost');
        $lastMonthAvailable = $BudgetLastMonth - $totalCostLastMonth;

        // TOTAL BUDGET SUM
        $totalBudget = BudgetModel::sum('budget');
        $totalCost = CostModel::sum('cost');
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
