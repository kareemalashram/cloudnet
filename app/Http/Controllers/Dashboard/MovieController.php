<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Jobs\StreamMovie;
use App\Movie;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:movies_read')->only(['index']);
        $this->middleware('permission:movies_create')->only(['create','store']);
        $this->middleware('permission:movies_update')->only(['edit','update']);
        $this->middleware('permission:movies_delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $movies = Movie::whenSearch($request->search)
            ->whenCategory($request->category)
            ->with('categories')
            ->paginate(5);
        $categories = Category::all();
        return view('dashboard.movies.home',compact('movies','categories'));

    }

    public function create(Request $request)
    {

            $movie = Movie::create([]);
            $categories = Category::all();
            return view('dashboard.movies.create',compact('movie','categories'));

    }



    public function store(Request $request)
    {
        $movie = Movie::FindOrFail($request->movie_id);
        $movie->update([
            'name' => $request->name,
            'path' => $request->file('movie')->store('movies'),
        ]);

        // the job
        $this->dispatch(new StreamMovie($movie));

        return $movie;
    }

    public function show (Movie $movie) {

        return $movie;
    }



    public function edit(movie $movie)
    {
        $categories = Category::all();
        return view('dashboard.movies.edit',compact('movie','categories'));
    }


    public function update(Request $request, movie $movie)
    {

        if ($request->type == 'publish'){


            $request->validate([

                'name' => 'required|unique:movies,name,' . $movie->id ,
                'description' => 'required',
                'poster' => 'required|image',
                'image' => 'required|image',
                'categories' => 'required|array',
                'year' => 'required',
                'rating' => 'required',

            ]);

        } else{

            //update
            $request->validate([

                'name' => 'required|unique:movies,name,' . $movie->id ,
                'description' => 'required',
                'poster' => 'sometimes|nullable|image',
                'image' => 'sometimes|nullable|image',
                'categories' => 'required|array',
                'year' => 'required',
                'rating' => 'required',

            ]);


        }
            $request_data = $request->except(['poster','image']);

        if ($request->poster){

            $this->remove_previous('poster',$movie);

            $poster = \Intervention\Image\Facades\Image::make($request->poster)
                ->resize(255,378)
                ->encode('jpg');

            Storage::disk('local')->put('public/images/'.$request->poster->hashName(),(string)$poster,'public');
            $request_data['poster'] = $request->poster->hashName();
        }


        if ($request->image){

            $this->remove_previous('image',$movie);

            $poster = \Intervention\Image\Facades\Image::make($request->image)
                ->encode('jpg',50);

            Storage::disk('local')->put('public/images/'.$request->image->hashName(),(string)$poster,'public');
            $request_data['image'] = $request->image->hashName();

        }


        $movie->update($request_data);
        $movie->categories()->sync($request->categories);

        session()->flash('success','Data update successfully');
        return redirect()->route('dashboard.movies.index');

    }


    public function destroy(movie $movie)
    {

        Storage::disk('local')->delete('public/images/' .$movie->poster);
        Storage::disk('local')->delete('public/images/' .$movie->image);
        Storage::disk('local')->delete($movie->path);
        Storage::disk('local')->deleteDirectory('public/movies/' .$movie->id);

        $movie->delete();
        session()->flash('success','Data delete successfully');
        return redirect()->route('dashboard.movies.index');
    }

    private function remove_previous($image_type , $movie){

        if ($image_type == 'poster'){

            if ($movie->poster != null){


                Storage::disk('local')->delete('public/images/'.$movie->poster);
            }
        }else {

            if ($movie->image != null){

                Storage::disk('local')->delete('public/images/'.$movie->image);
            }
        }
    }


}
