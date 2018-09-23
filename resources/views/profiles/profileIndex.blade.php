@extends('includes.layout')
@section('content')
<h1 class="font-weight-normal text-center">Profiles</h1>
<br>
<table class="table">
    <tr>
        
        <th colspan="2">Name</th>
        <th>User Type</th>
        <th>Occupation</th>
        <th></th>
    </tr>
    @foreach($profiles as $profile)
    <tr>
        <td>
            <div style="width: 50px; height: 50px; margin:auto; overflow: hidden; border-radius: 50%">
                <span class="d-flex justify-content-center align-items-center" style="height:50px;">
                    <img src="{{asset('storage/images/profilePhoto/' . $profile->profileImage)}}" style="height:130%;">
                </span>
            </div>
                {{-- <span class="font-weight-bold align-middle">{{$profile->first_name . ' ' . $profile->last_name}}</span></td> --}}
        <td class="font-weight-bold align-middle">{{$profile->full_name}}</td>
        {{-- <td class="align-middle">{{$profile->user_name}}</td> --}}
        <td class="align-middle">{{title_case($profile->roles()->first()->role)}}</td>
        <td class="align-middle">{{$profile->occupation ? title_case($profile->occupation) : 'N/A'}}</td>
        <td colspan="2" class="align-middle">
            <a href="#" class="btn btn-success float-right mx-1">Message</a>
            <a href="{{route('profile.show', $profile->id)}}" class="btn btn-primary float-right ml-1">View</a>
            <a href="{{route('blogByAuthor', $profile->id)}}" class="btn btn-primary float-right">View Posts</a>
        </td>
    </tr>
    
    </div>
    @endforeach
</table>
@endsection