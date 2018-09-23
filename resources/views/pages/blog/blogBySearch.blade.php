@extends('includes.layout')

@section('content')
    {{-- fix everything in container div --}}
    <div class="container"></div>
    <h1 class="font-weight-normal text-center">Blog Posts</h1>
    <hr>
    <form action="{{route('blogBySearch')}}" method="post" class="form">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-8">
            <select class="js-example-basic-multiple form-control" style="width:60%" name="tags[]" multiple="multiple">
                @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{ucwords($tag->tag)}}</option>
                @endforeach
            </select>
            <input type="submit" value="Search" class="btn btn-success">
            <a type="button" class="btn btn-danger" href="{{route('blogPage')}}">Clear Search</a>
        </div> 
        </div> 
    </form>
    <div>
        <p class="font-italic text-muted">Showing results for
            <strong>@foreach ($search_tags as $tag)
                @php($loop_count++)
                @if ($tags_count == $loop_count)
                {{$tag->tag}}
                @elseif($tags_count-1 == $loop_count)
                {{$tag->tag}} or 
                @else
                {{$tag->tag}}, 
                @endif
            @endforeach</strong>
            tag
        </p>
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
                        <p class="card-text"><i>No Subtitile provided for this post</i></p>
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

{{-- scripts --}}
<script>
        $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: "Search posts by Tags",
            width: "style",
        });
        });
    </script>
    
@endsection