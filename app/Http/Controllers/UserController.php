<?php

namespace App\Http\Controllers;

use App\Models\BottleDisposal;
use App\Models\User;
use App\Models\UserStats;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->where('id', '!=', 1)->where('status','Available')->get(); // 10 items per page
        return view('admin.user.index', compact( 'users'));
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
        'name' => 'required|max:100',
        'year_level' => 'required|max:50',
        'id_number' => 'required|max:50|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'role' => 'required|max:50',
    ]);

    $user = new User();
    $user->account_id = $this->generateUniqueAccountId();
    $user->name = $request->input('name');
    $user->year_level = $request->input('year_level');
    $user->id_number = $request->input('id_number');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password')); 
    $user->role = $request->input('role');
    $user->email_verified_at = now()->subHours(7);
    $user->save();
    

    UserStats::create([
        'user_id' => $user->id,
        'outstanding_points'=> 0,
        'total_accu_points'=> 0,
        'total_bottles_thrown' => 0
    ]);


    return to_route('user.index')->with('message', 'User was Successfully Added');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|max:100',
        'year_level' => 'required|max:50',
        'id_number' => 'required|max:50|unique:users,id_number,' . $user->id,
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8',
        'role' => 'required|max:50',
    ]);

    
    $user->name = $request->input('name');
    $user->year_level = $request->input('year_level');
    $user->id_number = $request->input('id_number');
    $user->email = $request->input('email');
    $user->role = $request->input('role');

    // Update the password only if a new one is provided
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    $user->save();

    return response()->json(['success' => 'User updated successfully!']);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->status = "Deleted"; 
        $user->save();  
        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }
    protected function generateUniqueAccountId()
    {
        do {
            $accountId = mt_rand(100000, 999999);
        } while (User::where('account_id', $accountId)->exists());

        return $accountId;
    }
}
