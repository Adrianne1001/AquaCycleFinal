<?php

namespace App\Http\Controllers;

use App\Models\BottleDisposal;
use Illuminate\Http\Request;

class BottleDisposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bottleDisposals = BottleDisposal::where('user_id', auth()->id())->orderBy('disposal_date', 'desc')->get();
        return view('user.BottleDisposal.index', compact('bottleDisposals'));
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
     * @param  \App\Models\BottleDisposal  $bottleDisposal
     * @return \Illuminate\Http\Response
     */
    public function show(BottleDisposal $bottleDisposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BottleDisposal  $bottleDisposal
     * @return \Illuminate\Http\Response
     */
    public function edit(BottleDisposal $bottleDisposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BottleDisposal  $bottleDisposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BottleDisposal $bottleDisposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BottleDisposal  $bottleDisposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(BottleDisposal $bottleDisposal)
    {
        //
    }
}
