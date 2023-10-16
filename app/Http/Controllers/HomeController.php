<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function change_password(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'password' => ['required', 'confirmed'],
        ]);

        User::where('id', Auth::id())
            ->update([
                'password' => bcrypt($request->password)
            ]);

        return redirect()->back()->with('success', 'Password has been changed successfully');
    }
}
