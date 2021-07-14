<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){


    }

    public function show(Movie $movie){

            $related_movies = Movie::where('id','!=',$movie->id)
            ->whereHas('categories',function ($query) use ($movie){

                return $query->whereIn('category_id',$movie->categories->pluck('id')->toArray());

            })->get();

        return view('layouts.movies.show',compact('movie','related_movies'));
    }

    public function increment_views(Movie $movie){


        $movie->increment('views');

    }


    public function toggle_favorite(Movie $movie){

        $movie->is_favored ? $movie->users()->detach(auth()->user()->id) : $movie->users()->attach(auth()->user()->id);
    }
}
