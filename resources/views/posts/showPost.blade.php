@extends('includes.layout')

@section('content')
    {{-- fix everything in container div --}}


    <div class="container"></div>
    {{-- <h1>{{$post->title}}</h1> --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-normal mb-1 d-inline">{{$post->title}}</h3>
                @if($post->user_id == Auth::id())
                    @if($post->visibility == 0)
                        <kbd class="bg-danger float-right">Hidden</kbd> 
                    @elseif($post->visibility == 1)
                        <kbd class="bg-success float-right">Visible</kbd>
                    @endif
                
                @endif
                <h5 class="card-title mb-1">{{$post->sub_title}}</h5>
                <p class = "small">Published by <a href="{{route('profile.show', $user->id)}}">{{$user->full_name}}</a></p>
            </div>
            <div class="card-body">
                
                @if ($post->image_name != 'NoImageUploaded.jpg')
                    <br>
                    <img src="{{asset('storage/images/' . $post->image_name)}}" alt="" style="width:100%"> 
                    <br><br>
                @endif
                <p class="card-text">{{$post->content}}</p>
            </div>
            <div class="card-footer py-1">
                <small class = "text-muted"><strong>Published : {{$post->formatted_created_date}}</strong></small>
                <strong>|</strong>
                <small class = "text-muted"><strong>{{$post->view_count}}</strong> Views</small>
                <strong>|</strong>
                <small class="text-muted"><strong>{{$post->likes}}</strong> Likes</small>
                @if($post->user_id !== Auth::id())
                    @if($post->post_likes->where('user_id', Auth::id())->first() === null)
                    <a href="like/{{$post->id}}" type="" class="float-right btn btn-primary p-1">
                        <i class="material-icons md-18 align-middle">thumb_up</i> Like</a>
                    @else
                    <a href="unlike/{{$post->id}}" type="" class="float-right btn btn-danger p-1">
                        <i class="material-icons md-18 align-middle">thumb_down</i> Unlike</a>
                    @endif
                @endif
            </div>
        </div>

        <div class="row">
            @if($post->user_id == Auth::id())
            <div class="col">
                <a href="{{asset('posts/'. $post->id . '/edit')}}" class="btn btn-primary mt-2">Edit</a>
            </div>
            <div class="col">    
                {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class'=>'delete' ]) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    <button type="submit" class="btn btn-danger float-right mt-2">Delete</button>
                {!! Form::close() !!}
            </div>
            @else
            <div class="col">
                    <button type="button" class="btn btn-success float-right mt-2" data-toggle="modal" data-target="#myModal">Send Mail</button>

                    <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Send a mail to the Author</h4>
                        </div>
                        <form action="{{route('posts.sendMail', $post->id)}}">
                        <div class="modal-body">
                            
                                <textarea name="feedback_message" id="" class="form-control" cols="30" rows="10"></textarea>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Send</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                        </div>

                    </div>
                    </div>

                </div>
            @endif
        </div>
        <div class="card my-4">
            <div class="card-header lead font-weight-normal">Comments</div>
            <div class="card-body">
                <div class="media bg-light border p-3 mb-3">
                    <img class="rounded-circle mr-3" src="{{asset('storage/images/profilePhoto/' . $current_commentor_photo)}}" alt="" style="width:50px;">


                    {!! Form::open(['action' => ['CommentsController@store', 'post_id' => $post->id], 'method' => 'POST', 'class' => 'form-control-range']) !!}
                        <div class="form-group m-0">
                            {{Form::label('comment', 'Enter your Comment')}}
                            {{Form::text('comment', '', ['class' => 'form-control'])}}
                        </div>
                        <div>
                            {{Form::submit('Comment', ['class' => 'btn btn-primary float-right mt-2'])}}
                        </div>
                    {!! Form::close() !!}


                </div>
                @foreach($comments as $comment)
                    <div class="media border p-3">
                        
                        <img class="rounded-circle mr-3" src="{{asset('storage/images/profilePhoto/' . $commentors->find($comment->user_id)->profileImage)}}" alt="" style="width:50px;">
                        
                        <div>
                            <h5 class="font-weight-bold m-0 text-primary">{{$commentors->find($comment->user_id)->first_name . ' ' . $commentors->find($comment->user_id)->last_name}}</h5>
                            <hr class="p-0 m-0">
                            <div>
                                <div>{{$comment->comment_body}}</div>
                                <small class="text-muted ">{{$comment->formatted_created_date}}</small class="text-muted ">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        

        <script>
            $(".delete").on("submit", function(){            
                return confirm("Are you sure you want to DELETE?");
            });
        </script>
        
    
@endsection