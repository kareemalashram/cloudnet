<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Movie;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {


        $user_count = User::whereRole('user')->count();
        $categories_count = Category::count();
        $movie_count = Movie::where('percent',100)->count();
        return view('dashboard.home' ,compact('user_count','categories_count','movie_count'));
    }




}
