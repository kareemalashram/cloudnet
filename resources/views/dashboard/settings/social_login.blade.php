@extends('layouts.dashboard.app')
@section('content')

    <div>
        <h1>Add settings</h1>
    </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Settings</li>
        </ul>


    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <form method="post" action="{{route('dashboard.settings.store')}}">
                    @csrf
                    @method('post')
                    @include('partials._errors')

                    <div class="row">

                        @php $social_sites =['facebook','google']  @endphp

                        @foreach($social_sites as $social_site )

                              <!--social_site client id -->
                                <div class="form-group col-md-4">
                                    <label>{{$social_site}} client id</label>
                                    <input type="text" name="{{$social_site}}_client_id" class="form-control" value="{{ setting($social_site. '_client_id')}}">
                               </div>
                               <!--end social_site client id  -->

                                <!--social_site client secret -->
                                <div class="form-group col-md-4">
                                    <label>{{$social_site}} client secret</label>
                                    <input type="text" name="{{$social_site}}_client_secret" class="form-control" value="{{ setting($social_site. '_client_secret')}}">
                                </div>
                                <!--end social_site client id  -->

                                <!--social_site redirect url -->
                                <div class="form-group col-md-4">
                                    <label>{{$social_site}} client id</label>
                                    <input type="text" name="{{$social_site}}_redirect_url" class="form-control" value="{{ setting($social_site. '_redirect_url')}}">
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