@extends('layouts.dashboard.app')
@section('content')

    <div>
        <h1>Add settings</h1>
    </div>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Home</a></li>
        <li class="breadcrumb-item active">Link</li>
    </ul>


    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <form method="post" action="{{route('dashboard.settings.store')}}">
                    @csrf
                    @method('post')
                    @include('partials._errors')

                    <div class="row">

                    @php $social_sites =['Facebook','Google','Youtube']  @endphp

                    @foreach($social_sites as $social_site )

                        <!--social_site client id -->
                            <div class="form-group col-md-12">
                                <label>{{$social_site}} Link</label>
                                <input type="text" name="{{$social_site}}_link" class="form-control" value="{{ setting($social_site. '_link')}}">
                            </div>
                            <!--end social_site client id  -->

                        @endforeach


                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" ><i class="fa fa-plus"></i>Add user </button>
                            </div>
                        </div>
                        <!--end of col -->
                    </div>

                </form> <!--end of form -->
            </div> <!--end of tile -->

        </div>
    </div>



@endsection