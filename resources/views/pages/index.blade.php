@extends('includes.layout')
@section('content')

<div class="jumbotron">
    <h1 class="display-3">Hello There..</h1>
    <p class="lead">
        Welcome to LaraPro. We've got some amazing stuff waiting for you.
        <br>
        Login to see our blog section, create your own posts to publish and many more functionalities.

    </p>
    <hr class="my-4">
    @guest
    <p class="lead">
        You can <span class="font-weight-bold">Login</span> here.
        <br>
        Don't have an account? <span class="font-weight-bold">Register</span> here to create your own account. It's completely free..
    </p>
    <a href="{{route('register')}}" class="btn btn-primary">Register</a>
    <a href="{{route('login')}}" class="btn btn-success">Login</a>
    @else
    <p class="lead">
            You are <span class="font-weight-bold">Logged In</span>
            {{-- Don't have an account? <span class="font-weight-bold">Register</span> here to create your own account. It's completely free.. --}}
        </p>
        <a href="{{route('posts.create')}}" class="btn btn-success">Create your own post</a>
        <a href="{{route('posts.index')}}" class="btn btn-primary">View your posts</a>
        <a href="{{route('blogPage')}}" class="btn btn-primary">Go to Blog</a>
    @endguest


</div>
    
@endsection