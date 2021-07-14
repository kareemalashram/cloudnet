@extends('layouts.dashboard.app')


@section('content')

    <h1>Dashboard</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Users</h4>
                    <p><b>{{$user_count}}</b></p>
                </div>
            </div>
        </div>
        <!-- end of Users  -->
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-bars fa-3x"></i>
                <div class="info">
                    <h4>Categories</h4>
                    <p><b>{{$categories_count}}</b></p>
                </div>
            </div>
        </div>
        <!-- end of Categories  -->

        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-youtube-play fa-3x"></i>
                <div class="info">
                    <h4>Movie</h4>
                    <p><b>{{$movie_count}}</b></p>
                </div>
            </div>
        </div>
        <!-- end of Movie  -->

    </div>



@endsection