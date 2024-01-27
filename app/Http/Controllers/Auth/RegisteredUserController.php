<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;

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
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),[
                'first_name' => ['required', 'string', 'max:30', 'alpha' ],
                'last_name' => ['required', 'string', 'max:30', 'alpha'],
                'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'], 
                'password' => ['required', 'confirmed', 'string', 'min:8', 'regex:/[A-Z]/', 'regex:/[a-z]/', 
                'regex:/[0-9]/', 'regex:/[@$!%*#?&]/' ],
            ]);
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Mail::to($user->email)->send(new MyTestMail($user->name));

        return to_route('login')->with('message', ' Successfully registered account!');
    }
}
