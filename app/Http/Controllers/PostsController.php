<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Category;

class PostsController extends Controller
{
    // authentication for urls
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_posts = Post::orderBy('created_at', 'desc')->where('user_id', Auth::id())->paginate(10);
        return view('posts.index')->with('posts', $user_posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('posts.createPost',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category' => 'integer|nullable',
            'visibility' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        $inputTitle = title_case($request->title);
        $inputSubTitle = title_case($request->sub_section);
        $post = new Post;
        $post->title = $inputTitle;
        $post->sub_title = $inputSubTitle;
        $post->content = $request->body;
        $post->category_id = $request->category;
        $post->visibility = $request->visibility;
        $post->user_id = Auth::id();
 


        if ($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;

            $post->image_name = $filenameToStore;       
            $request->file('image')->storeAs('public/images', $filenameToStore);
        } else {
            $post->image_name = "NoImageUploaded.jpg";
        }

        $post->save(); 

        return redirect('posts/create')->with('success', 'New post successfully created');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $post = Post::find($id);
        $user = User::where('id', $post->user_id)->first();
        $comments = $post->comments;
        $commentors = User::all();
        
        $current_commentor_photo = $commentors->find(Auth::id());
        $current_commentor_photo = ($current_commentor_photo->profileImage);
        
        return view('posts.showPost', compact(['post', 'user', 'comments', 'commentors', 'current_commentor_photo']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $category = Category::all();
        $current_category = $post->category;
        // return $edit_post;
        return view('posts.editPost', compact('post', 'category', 'current_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category' => 'integer|nullable',
            'visibility' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        
        $post = Post::find($id);
        // return($post);
        $post->title = $request->title;
        $post->sub_title = $request->sub_section;
        $post->category_id = $request->category;
        $post->content = $request->body;
        $post->visibility = $request->visibility;


        if ($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            if ($post->image_name != "NoImageUploaded.jpg"){
                Storage::delete('public/images/' . $post->image_name);
            }
            $post->image_name = $filenameToStore;
            $request->file('image')->storeAs('public/images', $filenameToStore);
        }


        $post->save(); 

        return redirect('posts')->with('success', 'Post successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // return('Post id to be deleted : ' . $post->id);
        if ($post->image_name != "NoImageUploaded.jpg"){
            Storage::delete('public/images/' . $post->image_name);
        }
        
        $post->delete();
        return redirect('posts')->with('success', 'Post deleted successfully');
    }
}
