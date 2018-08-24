@extends('includes.layout')

@section('content')
    
    <div class="container">

        <h1>Create a Blog Post</h1>
        
        {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                <label for = "title" class = "">Title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="This Is My Title">
                <small class="form-text text-muted">The main title of your post *</small>
            </div>
            <div class="form-group">
                <label for = "sub_section" class = "">Sub Title</label>
                <input type="text" id="sub_section" name="sub_section" class="form-control" placeholder="Sub-title goes here">
                <small class="form-text text-muted">Sub-titles are optional, but very useful to get to the readers</small>
            </div>
            <div class="form-group">
                <label for = "body" class = "">Blog Content</label>
                <textarea name="body" id="body" cols="" rows="10" class="form-control"></textarea>
                <small class="form-text text-muted">The body/content of your post *</small>
            </div>
            <div class="form-group">
                <label for="category">Select a suitable category for the post:</label>
                <select class="form-control" id="category" name="category">
                    <option value="" class="text-muted" selected>None</option>
                    @foreach($category as $category_item)
                    <option value="{{$category_item->id}}">{{$category_item->category_name}}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">This could help readers to sort your post easily</small>
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" name="image" id="image" class = "custom-file-input">
                    <label for = "image" class = "custom-file-label">Insert an Image with your post here..</label>
                    <small class="form-text text-muted">Image should not be larger than 2 megabytes</small>                    
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-radio">
                    <input type="radio" name="visibility" id="show" value='1' class="custom-control-input" checked=checked>
                    <label for = "show" class = "custom-control-label">Show Post</label>
                    
                </div>
                <br>
                <div class="custom-control custom-radio">
                    <input type="radio" name="visibility" id="hide" value='0' class="custom-control-input">
                    <label for = "hide" class = "custom-control-label">Hide Post</label>
                    
                </div>
                <div class="ui loading fluid multiple search selection dropdown">
                    <input name="country" value="kp" type="hidden">
                    <i class="dropdown icon"></i>
                    <input class="search">
                    <div class="default text">Search...</div>
                    <div class="menu">
                        <div class="item">Choice 1</div>
                        <div class="item">Choice 2</div>
                        <div class="item">Choice 3</div>
                    </div>
                </div>
                
            </div>
            <div>
                
                {{-- {{Form::submit('Create Post',['class' => 'btn btn-success'])}} --}}
                <button class="btn btn-success material-icons" type="submit" data-toggle="tooltip" title="Create Post" data-placement="top">create</button>
                <button class="btn btn-danger material-icons" type="reset" data-toggle="tooltip" title="Reset Form" data-placement="top">clear</button>
                <a class="btn btn-primary material-icons" href="{{asset('')}}" data-toggle="tooltip" title="Go Back to Home" data-placement="top">arrow_back</a>
                {{-- {{Form::button('Cancel',['type'=>'reset', 'class' => 'btn btn-danger'])}} --}}
                
            </div>
            
        {!! Form::close() !!}
    </div>
    

@endsection