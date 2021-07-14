@extends('layouts.dashboard.app')
@section('content')

    <div>
        <h1>Edit users</h1>
    </div>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('dashboard.users.index')}}">users</a></li>
        <li class="breadcrumb-item active">Add</li>
    </ul>


    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <form method="post" action="{{route('dashboard.users.update',$user->id)}}">
                    @csrf
                    @method('put')
                    @include('partials._errors')

                    <div class="row">


                        <div class="form-group col-md-6">
                            <h4>Name</h4>
                            <input type="text" name="name" class="form-control" value="{{old('name',$user->name)}}">
                        </div>
                        <!--end of col Name -->

                        <div class="form-group col-md-6">
                            <h4>Email</h4>
                            <input type="email" name="email" class="form-control" value="{{old('email',$user->email)}}">
                        </div>
                        <!--end of col email -->


                        <div class="form-group col-md-6">
                            <label>Role</label>
                            <select name="role_id" class="form-control select2 ">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{$user->hasRole($role->name) ? 'selected' : '' }} >{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" ><i class="fa fa-plus"></i>Edit user </button>
                            </div>
                        </div>
                        <!--end of col -->
                    </div>

                </form> <!--end of form -->
            </div> <!--end of tile -->

        </div>
    </div>



@endsection