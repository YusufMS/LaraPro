@extends('includes.layout')
@section('content')
<h3 class="text-center">Welcome to {{$profile->id == Auth::id() ? 'your' : $profile->first_name . "'s"}} Profile</h3>
<h2 class="display-4 text-center">{{$profile->full_name}}</h2>
<table class="table">
    <tr >
        <td colspan="2" class="text-center">

            <div style="width: 200px; height: 200px; margin:auto; overflow: hidden; border-radius: 50%">
                <span class="d-flex justify-content-center align-items-center" style="height:200px;">
                    <img src="{{asset('storage/images/profilePhoto/' . $profile->profileImage)}}" class="" style="height:130%;">
                </span>
            </div>

            </div>
            @if($profile->bio)
                <div class="px-5 py-3"><em>{{$profile->bio}}</em></div>
            @endif
            
        </td>
    <tr>
    <tr>
        <td>Name</td>
        <td>{{$profile->first_name . ' ' . $profile->last_name}}</td>
    </tr>
    <tr>
        <td>Username</td>
        <td>{{$profile->user_name}}</td>
    </tr>
    @if($profile->occupation)
        <tr>
            <td>Occupation</td>
            <td>{{$profile->occupation}}</td>
        </tr>
    @endif
    @if($profile->dob)
        <tr>
            <td>Age</td>
            <td>{{$profile->age}} years</td>
        </tr>
    @endif
    @if($profile->emailVisibility != 0)
        <tr>
            <td>E-Mail Address</td>
            <td>{{$profile->email}}</td>
        </tr>
    @endif
    @if($profile->contactNo)
        <tr>
            <td>Contact Number</td>
            <td>{{$profile->contactNo}}</td>
        </tr>
    @endif
    @if($profile->qualifications)
        <tr>
            <td>Qualifications</td>
            <td>{{$profile->qualifications}}</td>
        </tr>
    @endif
    @if($profile->interests)
        <tr>
            <td>Interests</td>
            <td>{{$profile->interests}}</td>
        </tr>
    @endif
    @if($profile->sex)
        <tr>
            <td>Gender</td>
            <td>{{$profile->sex == 0 ? 'Female' : 'Male'}}</td>
        </tr>
    @endif
    @if($profile->from)
        <tr>
            <td>From</td>
            <td>{{$profile->from}}</td>
        </tr>
    @endif
    @if($profile->livesIn)
        <tr>
            <td>Lives In</td>
            <td>{{$profile->livesIn}}</td>
        </tr>
    @endif
    @if($profile->socialMediaLinks)
        <tr>
        <td>Get in touch with {{$profile->first_name}} through Social Media</td>
            <td>
                <ul>
                    @foreach($social_media as $media)
                    @if($media)
                    <li><a href="">{{$media}}</a></li>
                    @endif
                    @endforeach
                </ul>
   
            </td>
            {{-- Should be properly displayed --}}
        </tr>
    @endif
    
    @if($profile->id == Auth::id())
    <tr>
        <td colspan="2">
            @if($profile->contactNo)
            <form action="{{route('profile.destroy', $profile->id)}}" method="POST" class="delete">
                <a class="btn btn-primary mr-3 mt-3" href="{{route('profile.edit', $profile->id)}}">Edit</a>
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger float-right mr-3 mt-3">Delete Profile</a>
            </form>
            @else
            <form action="{{route('profile.destroy', $profile->id)}}" method="POST" class="delete">
            <a class="btn btn-success mr-3 mt-3" href="{{route('profile.create')}}">Add Profile Details</a>
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger float-right mr-3 mt-3">Delete Profile</a>
            @endif
        </td>
    </tr>
    @endif
</table>

<script>
    $(".delete").on("submit", function(){
        return confirm("Deleting your account will delete all your posts and make you a visitor of this page. Are you sure you want to DELETE?");
    });
</script>

@endsection