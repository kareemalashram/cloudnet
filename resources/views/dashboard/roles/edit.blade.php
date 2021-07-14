@extends('layouts.dashboard.app')
@section('content')

<div>
    <h1>Edit Roles</h1>

</div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('dashboard.roles.index')}}">Roles</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="tile mb-4">
                        <form method="post" action="{{route('dashboard.roles.update',$role->id)}}">
                            @csrf
                            @method('put')
                            @include('partials._errors')

                                <div class="form-group">
                                    <h4>Name</h4>
                                    <input type="text" name="name" class="form-control" value="{{ old('name',$role->name)}}" >
                                </div>
                            <!--end of col -->

                            <div class="form-group">
                                <h4>Permission</h4>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 15%">Model</th>
                                        <th>Permission</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php
                                        $models     = ['categories','movies','users','settings'];
                                        $permission_maps = ['create','read','update','delete'];

                                    @endphp

                                    @foreach($models as $index => $model )
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{ $model }}</td>
                                            <td>
                                                @if($model == 'settings')
                                                    @php   $permission_maps = ['create','read']; @endphp
                                                @endif

                                                <select name="permissions[]" class="form-control select2" multiple>
                                                    @foreach($permission_maps as $permission_map )
                                                        <option value="{{ $model . '_' . $permission_map  }}" {{ $role->hasPermission($model . '_' . $permission_map ) ? 'selected' : ''}}>{{ $permission_map }}</option>
                                                    @endforeach
                                                </select>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end of col -->

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block" ><i class="fa fa-plus"></i>Edit Role </button>
                                </div>
                            </div>
                            <!--end of col -->

                        </form> <!--end of form -->
                    </div> <!--end of tile -->

                </div>
            </div>





@endsection