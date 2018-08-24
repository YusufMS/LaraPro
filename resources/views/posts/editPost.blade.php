@extends('includes.layout')

@section('content')

    
    <div class="container">

        <h1>Edit Blog Post</h1>
         
        {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                <label for = "title" class = "">Title</label>
                <input type="text" id="title" name="title" value="{{$post->title}}" class="form-control" placeholder="This Is My Title">
                <small class="form-text text-muted">The main title of your post *</small>
            </div>
            <div class="form-group">
                <label for = "sub_section" class = "">Sub Title</label>
                <input type="text" id="sub_section" name="sub_section" value="{{$post->sub_title}}" class="form-control" placeholder="Sub-title goes here">
                <small class="form-text text-muted">Sub-titles are optional, but very useful to get to the readers</small>
            </div>
            <div class="form-group">
                <label for = "body" class = "">Blog Content</label>
                <textarea name="body" id="body" cols="" rows="10" class="form-control">{{$post->content}}</textarea>
                <small class="form-text text-muted">The body/content of your post *</small>
            </div>
            <div class="form-group">
                <label for="category">Select a suitable category for the post:</label>
                <select class="form-control" id="category" name="category">
                    <option value="" class="text-muted">None</option>
                    @foreach($category as $category_item)
                    @if($category_item == $current_category)
                    <option value="{{$category_item->id}}" selected>{{$category_item->category_name}}</option>
                    @else
                    <option value="{{$category_item->id}}">{{$category_item->category_name}}</option>
                    @endif
                    @endforeach
                </select>
                <small class="form-text text-muted">This could help readers to sort your post easily</small>
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" name="image" id="image" class = "custom-file-input">
                    <label for = "image" class = "custom-file-label">Insert an Image with your post here..</label>
                    
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-radio">
                    <input type="radio" name="visibility" id="show" value='1' class="custom-control-input" {{$post->visibility == 1 ? 'checked=checked' : ''}}>
                    <label for = "show" class = "custom-control-label">Show Post</label>
                    
                </div>
                <br>
                <div class="custom-control custom-radio">
                    <input type="radio" name="visibility" id="hide" value='0' class="custom-control-input" {{$post->visibility == 0 ? 'checked=checked' : ''}}>
                    <label for = "hide" class = "custom-control-label">Hide Post</label>
                    
                </div>
                
            </div>
            
            <div>
                {{Form::hidden('_method', 'PUT')}}
                {{-- {{Form::submit('Edit Post',['class' => 'btn btn-primary'])}} --}}
                <button class="btn btn-primary material-icons" type="submit" data-toggle="tooltip" title="Edit Post" data-placement="top">edit</button>
                {{-- {{Form::button('Cancel',['type'=>'reset', 'class' => 'btn btn-danger'])}} --}}
                <button class="btn btn-danger material-icons" type="reset" data-toggle="tooltip" title="Reset Form" data-placement="top">clear</button>
                <a class="btn btn-primary material-icons" href="{{asset('posts')}}" data-toggle="tooltip" title="Go Back to Home" data-placement="right">arrow_back</a>
            </div>
            
        {!! Form::close() !!}
    </div>
    

@endsection