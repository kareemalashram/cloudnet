@extends('layouts.dashboard.app')

@push('style')

    <style>
        #movie__upload-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 25vh;
            flex-direction: column;
            cursor: pointer;
            border: 3px solid green;
        }
    </style>

@endpush

@section('content')

    <div>
        <h1>Add Movies</h1>
    </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('dashboard.movies.index')}}">movies</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ul>



    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">

                <!-- box upload -->

                <div id="movie__upload-wrapper"
                     onclick="document.getElementById('movie__file-input').click()"
                     style="display: {{$errors->any() ? 'none' : 'flex'}};"

                >
                        <i class="fa fa-video-camera fa-2x"></i>
                        <p>Click To Upload</p>

                    </div>

                     <input type="file"
                            name=""
                            data-movie-id="{{ $movie->id }}"
                            data-url ="{{route('dashboard.movies.store')}}"
                            id="movie__file-input"
                            style="display: none;">

                <!-- end box upload -->

                <!-- form  -->
                     <form id="movie__properties"
                           method="post"
                           action="{{route('dashboard.movies.update',['movie' => $movie->id , 'type' => 'publish'])}}"
                           enctype="multipart/form-data"
                            style="display: {{$errors->any() ? 'block' : 'none'}};"  >

                            @csrf
                            @method('put')
                            @include('partials._errors')

                            {{--<!-- progress bar -->--}}
                            <div class="col-md-12"  style="display: {{$errors->any() ? 'none' : 'block'}};" >
                                <div class="form-group">
                                    <h5 id="movie__upload-status">Uploading</h5>
                                    <div class="bs-component">
                                        <div class="progress mb-2">
                                            <div id="movie__upload-progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Poster</label>
                                        <input type="file" name="poster" class="form-control image" >
                                    </div>
                                </div>

                                <div class="col-md-12">
                                 <div class="form-group">
                                     <img src="" style="width: 100px;" class="img-thumbnail image-preview">
                                 </div>
                                </div>

                                <!-- image -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control image2" >
                                    </div>
                                </div>

                             <div class="col-md-12">
                                 <div class="form-group">
                                     <img src="" style="width: 100px;" class="img-thumbnail image-preview2">
                                 </div>
                             </div>

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
                                 <button type="submit" id="movie__submit-btn" style="display: {{$errors->any() ? 'block' : 'none'}};" class="btn btn-primary" ><i class="fa fa-plus"></i>Add movie </button>
                             </div>
                         </div>  <!--end of col -->
                     </form> <!--end of form -->

            </div> <!--end of tile -->

        </div>
    </div>



@endsection