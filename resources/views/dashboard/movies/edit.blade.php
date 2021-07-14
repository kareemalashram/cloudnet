@extends('layouts.dashboard.app')

@push('style')

@endpush

@section('content')

<div>
    <h1>Edit Movies</h1>

</div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('dashboard.movies.index')}}">movies</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="tile mb-4">
                        <!-- form  -->
                        <form id="movie__properties"
                              method="post"
                              action="{{route('dashboard.movies.update',['movie' => $movie->id , 'type' => 'update'])}}"
                              enctype="multipart/form-data"
                               >

                            @csrf
                            @method('put')
                            @include('partials._errors')


                            <!-- Name -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="movie__name" class="form-control" value="{{old('name',$movie->name)}}" >
                                </div>
                            </div>

                            <!-- description -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" > {{old('description',$movie->description)}}</textarea>
                                </div>
                            </div>

                            <!-- poster -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Poster</label>
                                        <input type="file" name="poster" class="form-control image" >
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{$movie->poster_path}}" style="margin-top:10px; width: 255px; height: 378px; " class="img-thumbnail image-preview">
                                    </div>
                                </div>

                            {{--<div class="col-md-2">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Poster</label>--}}
                                    {{--<input type="file" name="poster" class="form-control" >--}}
                                    {{--<img src="{{$movie->poster_path}}" style="margin-top:10px; width: 255px; height: 378px; " class="img-thumbnail image-preview">--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <!-- image -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control image2" >
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{$movie->image_path}}" style="margin-top:10px; width: 300px; height: 300px; " class="img-thumbnail image-preview2">
                                    </div>
                                </div>

                                {{--<div class="col-md-2">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Image</label>--}}
                                    {{--<input type="file" name="image" class="form-control" >--}}
                                    {{--<img src="{{$movie->image_path}}" style="margin-top:10px; width: 300px; height: 300px; " class="img-thumbnail image-preview">--}}
                                   {{--</div>--}}
                                {{--</div>--}}

                            <!-- categories -->

                            <div class="form-group col-md-12">
                                <label>Category</label>
                                <select name="categories[]" class="form-control select2" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{in_array($category->id , $movie->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <a href="{{route('dashboard.categories.create')}}">Create Category</a>
                            </div>

                            <!-- year -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Year</label>
                                    <input type="text" name="year" class="form-control" value="{{ old('year',$movie->year) }}" >
                                </div>
                            </div>


                            <!-- rating -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Rating</label>
                                    <input type="number" min="1" name="rating" class="form-control" value="{{ old('rating',$movie->rating) }}" >
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" id="movie__submit-btn"  class="btn btn-primary btn-block" ><i class="fa fa-upload"></i>Edit movie </button>
                                </div>
                            </div>  <!--end of col -->
                        </form> <!--end of form -->
                    </div> <!--end of tile -->

                </div>
            </div>





@endsection