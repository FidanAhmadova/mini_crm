<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Deal;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        // Last 6 months revenue from won deals
        $labels = [];
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M');
            $sum = Deal::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->where('status', 'won')
                ->sum('amount');
            $data[] = (float) $sum;
        }

        // Deal status counts
        $dealStatusCounts = [
            'won' => Deal::where('status', 'won')->count(),
            'in_progress' => Deal::where('status', 'in_progress')->count(),
            'new' => Deal::where('status', 'new')->count(),
            'lost' => Deal::where('status', 'lost')->count(),
        ];

        // KPI counts (kept here for one-pass render if needed later)
        $kpis = [
            'companies' => Company::count(),
            'customers' => Customer::count(),
            'activeDeals' => Deal::whereIn('status', ['new','in_progress'])->count(),
            'pendingTasks' => Task::where('status', 'pending')->count(),
        ];

        return view('dashboard', [
            'revenueLabels' => $labels,
            'revenueData' => $data,
            'dealStatusCounts' => $dealStatusCounts,
            'kpis' => $kpis,
        ]);
    }
}
