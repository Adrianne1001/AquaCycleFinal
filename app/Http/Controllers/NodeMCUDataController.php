<?php

namespace App\Http\Controllers;

use App\Models\BottleDisposal;
use App\Models\RewardExchange;
use App\Models\User;
use App\Models\UserStats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NodeMCUDataController extends Controller
{
    public function store(Request $request)
    {
        Log::info($request->all());
        $validated = $request->validate([
            'points_received' => 'required|numeric',
            'bottles_qty' => 'required|numeric',
            'UID' => 'required|string',
            'water_convert' => 'required|numeric',
            'small_qty' => 'required|numeric',
            'med_qty' => 'required|numeric',
            'large_qty' => 'required|numeric',
            'xl_qty' => 'required|numeric',
            'xxl_qty' => 'required|numeric',
             '  ' => 'required|string'
        ]);
        $user = User::where('account_id', $validated['UID'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'Account ID not found.'
            ], 404);
        }

        BottleDisposal::create([
            'user_id' => $user->id,
            'points_received' => $validated['points_received'],
            'bottles_qty' => $validated['bottles_qty'],
            'small_qty' => $validated['small_qty'],
            'med_qty' => $validated['med_qty'],
            'large_qty' => $validated['large_qty'],
            'xl_qty' => $validated['xl_qty'],
            'xxl_qty' => $validated['xxl_qty'],
            'disposal_date'=> now()->subHours(7),
            'trashbag_fill_status' => $validated['trashbag_fill_status']
        ]);

        RewardExchange::create([
            'user_id' => $user->id,
            'reward_id' => 1, 
            'qty' => $validated['water_convert'],
            'status' => "Redeemed"
        ]);

        $pointsRemainAfterConvert = $validated['points_received'] - $validated['water_convert'] * 3;
        $userStats = UserStats::where('user_id',$user->id )->first();
        $userStats->update([
            'outstanding_points' => $userStats->outstanding_points +  $pointsRemainAfterConvert,
            'total_accu_points' => $userStats->total_accu_points +  $validated['points_received'],
            'total_bottles_thrown' => $userStats->total_bottles_thrown + $validated['bottles_qty']
        ]);

        return response()->json(['message' => 'Data stored successfully!'], 200);
    }
}
