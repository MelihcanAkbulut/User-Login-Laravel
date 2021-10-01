<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->is_admin == 1)
        {
            $today = Carbon::today();
            $add_Today = $today->addDay();
            $total_users = User::where('email_verified_at', null)->where('one_day_created_at', '<=', Carbon::now())->count();
            $today_registered = User::whereBetween('email_verified_at', [Carbon::today(),$add_Today])->count();
            $users = User::select("*")
                ->whereNotNull('last_seen')
                ->orderBy('last_seen', 'DESC')
                ->paginate(10);
            return view('admin', compact('total_users', 'today_registered', 'users'));
        } else {
            return view('home');
        }
        //$users = User::where('email_verified_at', null)->where('one_day_created_at', '<=', Carbon::now())->get();
        //$user = User::where('email_verified_at', null)->first();
        //dd($user->created_at, gettype($user->created_at), $user->one_day_created_at, gettype($user->one_day_created_at));

    }
}
