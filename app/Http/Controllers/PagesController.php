<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

use App\Category;
use App\User;
use App\Tag;

class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['blog','profile']);
    }

    public function index(){
        return view('pages.index');
    }

    public function blog(){
        $posts = Post::where('visibility', 1)->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();
        $tags = Tag::all();
        return view('pages.blog.blog', compact('posts', 'categories', 'tags'));
    }

    public function blogByCategory($id){

        $categories = Category::all();
        
        $posts = Category::find($id)->posts()->where('visibility', 1)->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.blog.blog', compact('posts', 'categories', 'id'));
    }

    public function blogByAuthor($id){
        $posts = Post::where('visibility', 1)->where('user_id', $id)->orderBy('created_at', 'desc')->paginate();
        $author = User::find($id);
        return view('pages.blog.blogByAuthor', compact('posts','author'));
    }

    public function about(){

        return view('pages.about');
    }


    // defined in ProfileController
    // public function profile(){
    //     return view('pages.profile');
    // }

    public function contact(){
        return view('pages.contact');
    }

    // public function search(){
    //     return ('ABC');
    // }

    public function dashboard(){
        //dashboard
    }

    
}
