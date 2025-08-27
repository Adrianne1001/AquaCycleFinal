<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserStats;
use Illuminate\Http\Request;

class ApiUserDataController extends Controller
{
    public function fetchUserData(Request $request)
    {
        $uid = $request->query('uid');
        $user = User::where('account_id', $uid)->first();
        

        if ($user) {
            $userStats = UserStats::where('user_id', $user->id)->first();
            return response()->json([
                'exists' => true,
                'points' => $userStats->outstanding_points
            ], 200);
        } else {
            return response()->json([
                'exists' => false
            ], 404);
        }
    }
}
