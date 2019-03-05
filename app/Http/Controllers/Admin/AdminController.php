<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->except('index');
    }

    public function index()
    {
        if(Auth::check()){
            return redirect()->route('admin.users.index');
        } else{
            return view('admin.login');
        }
    }
}
