<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserStats;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $email = $request->email;
        $role = 'Others';

        if (preg_match('/^[a-zA-Z0-9._%+-]+@dorsu\.edu\.ph$/', $email)) {
            $role = 'Student';
        }

        $user = User::create([
            'account_id' => $this->generateUniqueAccountId(),
            'name' => $request->name,
            'year_level' => $request->year_level,
            'id_number' => $request->id_number,
            'email' => $email,
            'password' => Hash::make($request->password),
            'role' => $role
        ]);
        UserStats::create([
            'user_id' => $user->id,
            'outstanding_points'=> 0,
            'total_accu_points'=> 0,
            'total_bottles_thrown' => 0
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    protected function generateUniqueAccountId()
    {
        do {
            $accountId = mt_rand(100000, 999999);
        } while (User::where('account_id', $accountId)->exists());

        return $accountId;
    }
}
