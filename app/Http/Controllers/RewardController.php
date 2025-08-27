<?php

namespace App\Http\Controllers;

use App\Models\reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewards = reward::orderBy('created_at', 'desc')->where('id', '!=', 1)->where('status','Available')->get();
        return view('admin.reward.index', compact( 'rewards'));
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
    $request->validate([
        'description' => 'required|max:50',
        'avail_qty' => 'required|max:50',
        'points_required' => 'required|numeric',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size: 2MB
    ]);

    $reward = new reward();
    $reward->description = $request->input('description');
    $reward->avail_qty = $request->input('avail_qty');
    $reward->points_required = $request->input('points_required');
    $reward->status = "Available";
    if ($request->hasFile('image_url')) {
        $image_url = $request->file('image_url');
        $imageName = time() . '_' . uniqid() . '.' . $image_url->getClientOriginalExtension();
        
        $imagePath = $image_url->storeAs('rewards', $imageName, 'public');
        $reward->image_url = $imagePath;
    }

    $reward->save();
    return to_route('reward.index')->with('message', 'Reward was Successfully Added');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function show(reward $reward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function edit(reward $reward)
    {
        return response()->json($reward);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\reward  $reward
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, reward $reward)
    // {
    //     $request->validate([
    //         'description' => 'required|string|max:50',
    //         'avail_qty' => 'required|integer',
    //         'points_required' => 'required|integer',
    //         'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);
    
    //     // Handle file upload
    //     $imagePath = $reward->image_url; // Keep the existing image by default
    
    //     if ($request->hasFile('image_url')) {
    //         // Delete the old image if necessary
    //         if ($reward->image_url) {
    //             Storage::disk('public')->delete($reward->image_url);
    //         }
    //         $imagePath = $request->file('image_url')->store('images/rewards', 'public');
    //     }
    
    //     // Update the reward
    //     $reward->update([
    //         'description' => $request->description,
    //         'avail_qty' => $request->avail_qty,
    //         'points_required' => $request->points_required,
    //         'image_url' => $imagePath,
    //     ]);
    
    //     return response()->json(['success' => 'Reward updated successfully.']);
    // }
    public function update(Request $request, Reward $reward)
    {
    $request->validate([
        'description' => 'required|max:50',
        'avail_qty' => 'required|integer',
        'points_required' => 'required|integer',
        'image_url' => 'image|nullable|max:2048', 
    ]);

    // Update the reward fields
    $reward->description = $request->description;
    $reward->avail_qty = $request->avail_qty;
    $reward->points_required = $request->points_required;

    // Check if a new image is uploaded
    if ($request->hasFile('image_url')) {
        // Store the new image
        $path = $request->file('image_url')->store('rewards', 'public');

        // Delete the old image if it exists
        if ($reward->image_url && Storage::disk('public')->exists($reward->image_url)) {
            Storage::disk('public')->delete($reward->image_url);
        }

        // Update the image_url with the new path
        $reward->image_url = $path;
    }

    // Save the updated reward
    $reward->save();

    return response()->json(['success' => 'Reward updated successfully!']);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reward $reward)
    {
        $reward->status = "Deleted"; 
        $reward->save();  
        return redirect()->route('reward.index')->with('success', 'Reward deleted successfully!');
    }
    
}
