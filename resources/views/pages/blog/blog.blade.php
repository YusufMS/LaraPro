@extends('includes.layout')

@section('content')
    {{-- fix everything in container div --}}
    <div class="container"></div>
    <h1 class="font-weight-normal text-center">Blog Posts</h1>
    <hr>
    <div class="py-4">
        <h5>Post Categories</h5>
        @if(isset($id))
        @foreach($categories as $category)
        <a class="btn btn-sm btn-outline-primary my-1 {{ $id == $category->id ? 'active' : ''}}" href="{{route('blogByCategory', [$category->id])}}">{{$category->category_name}}</a>
        @endforeach
        <div><a class="btn btn-sm btn-outline-danger my-1" href="{{route('blogPage')}}">Clear Categories</a></div>
        
        <div class="pt-2 font-italic text-muted">Showing results for "{{$categories->find($id)->category_name}}" category</div>
        @else
        @foreach($categories as $category)
        <a class="btn btn-sm btn-outline-primary" href="{{route('blogByCategory', [$category->id])}}">{{$category->category_name}}</a>
        @endforeach
        @endif
        
    </div>
    <div>
    @if($posts->count() == 0)
    <p class="text-center lead">-No posts to show here right now-</p>

    @else
    @foreach($posts as $post)
        <div class="card">
            <div class="row no-gutters">
                    <div class="col-md-4 col-sm-4 p-0" style="height: 164px; margin:auto; position: relative; overflow: hidden;">
                    <img src="{{asset('storage/images/' . $post->image_name)}}" alt="" class="mx-auto d-block" style="height:100%">
                </div>
                <div class="col-md-8 col-sm-8">
                    <div class="card-header">
                        <h3 class="card-title m-0 d-inline">{{$post->title}}</h3>
                        {!!isset($post->category_id) ? '<small><kbd class="bg-info float-right">' . $post->category->category_name . '</kbd></small>' : '<small class="text-muted font-italic float-right">No Category Specified</small>'!!}</kbd>
                    </div>
                    <div class="card-body">
                        @if($post->sub_title)
                        <p class="card-text">{{$post->sub_title}}</p>
                        @else
                        <p class="card-text">
                            <i>No Subtitile provided for this post</i>
                        </p>
                        @endif
                    </div>            

                    <div class="card-footer py-0">
                        <small class="text-muted">Written by <strong>{{$post->user->full_name}}</strong> {{$post->formatted_created_date}}</small>
                        <a class="btn btn-primary float-right my-1" href="{{asset('posts/' . $post->id . '_' . $post->title)}}">View</a>
                        
                        <br><br>
                    </div>
                </div>
            </div>
    </div>
        <br>
    @endforeach
    <div class="d-flex justify-content-center">
        {{$posts->links()}}
    </div>
    @endif
</div>
    
@endsection