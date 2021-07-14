@extends('layouts.dashboard.app')
@section('content')

    <h1>Add categories</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('dashboard.categories.index')}}">Categories</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
    </nav>



    <div class="tile mb-4">
        <form method="post" action="{{route('dashboard.categories.store')}}">
            @csrf
            @method('post')
            @include('partials._errors')

            <div class="col-md-6">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            </div> <!--end of col -->

            <div class="col-md-4">
            <div class="form-group">
                <button type="submit" class="btn btn-primary " ><i class="fa fa-plus"></i>Add</button>
            </div>
            </div><!--end of col -->

        </form> <!--end of form -->
    </div> <!--end of tile -->



@endsection