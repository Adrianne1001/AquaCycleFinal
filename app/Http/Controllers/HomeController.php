<?php

namespace App\Http\Controllers;

use App\Models\BottleDisposal;
use App\Models\RewardExchange;
use App\Models\User;
use App\Models\UserStats;
use Illuminate\Http\Request;
use App\Enums\Faculty;

class HomeController extends Controller
{
    public function admin()
    {
        // Existing data for reward exchanges, users, etc.
        $rewardExchanges = RewardExchange::with('user')->orderBy('created_at', 'desc')->get();
        $successfulExchanges = $rewardExchanges->where('status', 'Redeemed')->count();
        $rejectedExchanges = $rewardExchanges->where('status', 'Rejected')->count();
        $usersCount = User::count() - 1;
        $totalCollectedBottles = BottleDisposal::sum('bottles_qty');
        $trashbagStatus = BottleDisposal::latest()->value('trashbag_fill_status');
        $studentRankings = UserStats::join('users', 'user_stats.user_id', '=', 'users.id')->where('user_id', '!=', 1)->orderByDesc('user_stats.total_accu_points')->get();


        $dailyPoint = BottleDisposal::selectRaw('DATE(disposal_date) as date, SUM(points_received) as total_point')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $dailyLabels = $dailyPoint->pluck('date')->map(function ($date) {
            return date('M d', strtotime($date));
        });

        $dailyPoints = $dailyPoint->pluck('total_point');

        $monthlyBottleDisposalPerFaculty = BottleDisposal::selectRaw('MONTH(disposal_date) as month, YEAR(disposal_date) as year, users.faculty, SUM(bottles_qty) as total_bottleDisposal')
            ->join('users', 'bottle_disposals.user_id', '=', 'users.id')
            ->groupBy('year', 'month', 'users.faculty')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $monthlyLabels = $monthlyBottleDisposalPerFaculty->unique('month')->pluck('month')->map(function ($month) {
            return date('F', mktime(0, 0, 0, $month, 1));
        });

        $faculties = Faculty::cases();
        $facultyData = [];
        $facultiesCollection = collect($faculties);

        $facultyNames = $facultiesCollection->map(fn($faculty) => $faculty->label());  
        $facultyValues = $facultiesCollection->map(fn($faculty) => $faculty->value); 

        foreach ($faculties as $faculty) {
            $facultyData[$faculty->value] = [];
        
            foreach ($monthlyLabels as $monthLabel) {
                $monthNumber = date('m', strtotime($monthLabel));
        
                $data = $monthlyBottleDisposalPerFaculty->firstWhere(function ($item) use ($monthNumber, $faculty) {
                    return $item->month == $monthNumber && $item->faculty == $faculty->value;
                });
    
                $facultyData[$faculty->value][] = $data ? $data->total_bottleDisposal : 0;
            }
        }
        
        
        // Get bottle sizes data by month
        $monthlySizeData = [
            'small' => [],
            'medium' => [],
            'large' => [],
            'xl' => [],
            'xxl' => []
        ];

        // Query for bottle sizes by month
        $sizesByMonth = BottleDisposal::selectRaw('
            MONTH(disposal_date) as month, 
            YEAR(disposal_date) as year, 
            SUM(small_qty) as total_small,
            SUM(med_qty) as total_medium,
            SUM(large_qty) as total_large,
            SUM(xl_qty) as total_xl,
            SUM(xxl_qty) as total_xxl
        ')
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        // Create separate labels for size chart
        $sizeMonthLabels = $sizesByMonth->map(function ($disposal) {
            return date('F', mktime(0, 0, 0, $disposal->month, 1));
        })->unique()->values()->toArray();

        // Create arrays for each size using the size-specific months
        foreach ($sizeMonthLabels as $monthLabel) {
            $monthNumber = date('m', strtotime($monthLabel));
            
            // Find the record for this month
            $monthRecord = $sizesByMonth->first(function($item) use ($monthNumber) {
                return $item->month == $monthNumber;
            });
            
            // Add data if found, otherwise add 0
            $monthlySizeData['small'][] = $monthRecord ? $monthRecord->total_small : 0;
            $monthlySizeData['medium'][] = $monthRecord ? $monthRecord->total_medium : 0;
            $monthlySizeData['large'][] = $monthRecord ? $monthRecord->total_large : 0;
            $monthlySizeData['xl'][] = $monthRecord ? $monthRecord->total_xl : 0;
            $monthlySizeData['xxl'][] = $monthRecord ? $monthRecord->total_xxl : 0;
        }
        
        $sizeNames = ['Small', 'Medium', 'Large', 'Extra Large', 'Double Extra Large'];
        

        return view("admin.dashboard", compact(
            'rewardExchanges',
            'successfulExchanges',
            'rejectedExchanges',
            'usersCount',
            'totalCollectedBottles',
            'trashbagStatus',
            'dailyPoint',
            'dailyPoints',
            'dailyLabels',
            'monthlyBottleDisposalPerFaculty',
            'monthlyLabels',
            'facultyData',
            'facultyNames',
            'facultyValues',
            'studentRankings',
            'monthlySizeData',
            'sizeNames',
            'sizeMonthLabels'
        ));
    }
    public function student(){
        $userStats = UserStats::with('user')->where('user_id', auth()->id())->first();
        $rewardExchanges = RewardExchange::with('user')->where('user_id',auth()->id())->orderBy('created_at', 'desc')->get();

        $successfulExchanges = $rewardExchanges->where('status','Redeemed')->where('qty', '!=', 0)->count();
        $rejectedExchanges = $rewardExchanges->where('status','Rejected')->count();

        $dailyPoint = BottleDisposal:: selectRaw('DATE(disposal_date) as date, SUM(points_received) as total_point')
            ->where('user_id', auth()->id())
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $monthlyBottleDisposal = BottleDisposal::selectRaw('MONTH(disposal_date) as month, YEAR(disposal_date) as year, SUM(bottles_qty) as total_bottleDisposal')
            ->where('user_id', auth()->id())
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $dailyLabels = $dailyPoint->pluck('date')->map(function ($date) {
            return date('M d', strtotime($date));
        });

        $dailyPoints = $dailyPoint->pluck('total_point');

        $monthlyLabels = $monthlyBottleDisposal->map(function ($disposal) {
            return date('F', mktime(0, 0, 0, $disposal->month, 1)); // Convert month number to month name
        });

        $monthlyBottleDisposals = $monthlyBottleDisposal->pluck('total_bottleDisposal');

        return view("user.dashboard", compact(
            'rewardExchanges',
            'userStats',
            'successfulExchanges',
            'rejectedExchanges',
            'dailyPoint',
            'dailyPoints',
            'dailyLabels',
            'monthlyBottleDisposal',
            'monthlyBottleDisposals',
            'monthlyLabels'));
    }
}
