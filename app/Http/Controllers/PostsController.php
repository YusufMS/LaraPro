<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Mail\PostFeedback;
use Illuminate\Support\Facades\Mail;
use App\Post;
use App\User;
use App\Category;
use App\Tag;
use App\PostTag;
use App\Comment;
use App\PostLikes;
use Alert;

// Namespace for notifications
use App\Notifications\PostLike;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

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
        $tags = Tag::all();
        return view('posts.createPost',compact('category', 'tags'));
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
 
        // Saving image path
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

        // Saving tags of the post to pivot table
        $tags = Tag::all()->pluck('tag')->toArray();
        // return $request;
        if(!is_null($request->tags)){
        foreach ($request->tags as $post_tag){
            if (is_numeric($post_tag)){
                $check_tag = strtolower(Tag::find($post_tag)->tag);
            } else {
                $check_tag = strtolower($post_tag);
            }
            
            
            if(!in_array($check_tag, $tags)){
                // return $tags;
                $new_tag = new Tag;
                $new_tag->tag = $check_tag;
                $new_tag->save();
                $post_tags = new PostTag;
                $post_tags->post_id = $post->id;
                $post_tags->tag_id = $new_tag->id;
                $post_tags->save();
            }else{
                $post_tags = new PostTag;
                $post_tags->post_id = $post->id;
                $post_tags->tag_id = $post_tag;
                $post_tags->save();
            }
        }}
        // foreach ($request->tags as $post_tag){
        //     $post_tags = new PostTag;
        //     $post_tags->post_id = $post->id;
        //     $post_tags->tag_id = $post_tag;
        //     $post_tags->save();
        // }
        Alert::success('New post was successfully created', 'Post Created')->autoclose(2500);
        return redirect('posts/create');
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
        if ($post->user_id !== Auth::id()){
            $post->view_count = $post->view_count+1;
            $post->save();
        }
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
        Alert::success('Post was successfully updated', 'Update Successful')->autoclose(2500);
        return redirect('posts');
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
        Alert::success('Post was successfully deleted', 'Post Deleted')->autoclose(2500);
        return redirect('posts');
    }

    public function notificationClick($notification_id, $post_id)
    {
        // return 'ABC';
        $user = Auth::user();
        $notification = $user->notifications->where('id', $notification_id)->first();
        $notification->markAsRead();
        // $id = Comment::find($notification->data['comment_id'])->post->id;
        return redirect('posts/' . $post_id);
    }
    
    public function postLike($id){
        $post = Post::find($id);
        $post->likes = $post->likes + 1;
        $post->save();

        $post_like = new PostLikes;
        $post_like->post_id = $id;
        $post_like->user_id = Auth::id(); 
        $post_like->save();

        // sending notification
        $to_user = $post->user;
        $to_user->notify(new PostLike($post));

        return back();
        // return "Avll";
    }

    public function postUnlike($id){
        $post = Post::find($id);
        $post->likes = $post->likes - 1;
        $post->save();

        $post_like_id = $post->post_likes->where('user_id', Auth::id())->first()->id;

        $post_like = PostLikes::find($post_like_id);
        $post_like->delete();

        return back();
        // return "Avll";
    }

    public function send(Request $request, $id)
    {
        $post = Post::find($id);

        $mail_info = new \stdClass();
        $mail_info->post_title = $post->title;
        $mail_info->feedback = $request->feedback_message;
        $mail_info->sender = Auth::user()->full_name;
        $mail_info->receiver = $post->user->full_name;
        
        Mail::to("yousuf2ysf@gmail.com")->send(new PostFeedback($mail_info));
        Alert::success('Your e-mail was sent successfully', 'E-mail Sent')->autoclose(2500);
        return back();
    }
}
