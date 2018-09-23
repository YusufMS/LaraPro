<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

use App\Notifications\PostComment;
use Illuminate\Notifications\Notifiable;    
use Illuminate\Support\Facades\Notification;


class CommentsController extends Controller
{

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
        
        $comment = Comment::orderBy('created_at', 'desc')->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'comment' => 'required',
        ]);
        
        // Post_id obtained from the view through the request as a query
        // $post = Post::find($request->post_id);
        
        // $user_id = Auth::id();
        // $user = User::find($user_id);

        $comment = new Comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::id();
        $comment->comment_body = $request->comment;
        $comment->save();

        // Sending Notifications
        // $from_user = User::find(Auth::id());
        if(Auth::id() !== $comment->post->user->id){
            $to_user = User::find($comment->post->user->id);
            $to_user->notify(new PostComment($comment));
        }
        
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
