<?php

namespace App\Http\Controllers;

use App\Models\RewardExchange;
use App\Models\UserStats;
use Illuminate\Http\Request;

class AdminRewardExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewardExchanges = RewardExchange::with(['reward','user'])->whereIn('status', ["Pending","Approved"])->orderBy('created_at', 'desc')->get();
        return view('admin.RewardExchange.index', compact('rewardExchanges'));
    }
    public function claim($id){
        $rewardExchange = RewardExchange::find($id);
        $rewardExchange->update([
            'status' => "Redeemed"
        ]);
        return redirect()->route('admin_reward_exchange.index');
    }
    public function approve($id){
        $rewardExchange = RewardExchange::find($id);
        $rewardExchange->update([
            'status' => "Approved"
        ]);
        return redirect()->route('admin_reward_exchange.index');
    }

    public function reject($id){
        $rewardExchange = RewardExchange::find($id);
        $rewardExchange->update([
            'status' => "Rejected"
        ]);

        $reqPts = $rewardExchange->reward->points_required;
        $qtyReq = $rewardExchange->qty;
        $totalPts = $reqPts * $qtyReq;

        $userStats = UserStats :: find($rewardExchange->user_id);
        if ($userStats) {
            $updatedPts = $userStats->outstanding_points + $totalPts;
            $userStats->update([
                'outstanding_points' => $updatedPts,
            ]);
        }else {
        return redirect()->back()->withErrors('User stats not found.');
        }

        return redirect()->route('admin_reward_exchange.index');
    }
    public function SuccessfulRedeems(){
        $rewardExchanges = RewardExchange::with(['reward','user'])->where('status', 'Redeemed')->orderBy('created_at', 'desc')->get();
        return view('admin.RewardExchange.SuccessfulRedeems', compact('rewardExchanges'));
    }
    public function RejectedRequests(){
        $rewardExchanges = RewardExchange::with(['reward','user'])->where('status', 'Rejected')->orderBy('created_at', 'desc')->get();
        return view('student.RewardExchange.RejectedRequests', compact('rewardExchanges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RewardExchange  $rewardExchange
     * @return \Illuminate\Http\Response
     */
    public function show(RewardExchange $rewardExchange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RewardExchange  $rewardExchange
     * @return \Illuminate\Http\Response
     */
    public function edit(RewardExchange $rewardExchange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RewardExchange  $rewardExchange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RewardExchange $rewardExchange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RewardExchange  $rewardExchange
     * @return \Illuminate\Http\Response
     */
    public function destroy(RewardExchange $rewardExchange)
    {
        //
    }
}
