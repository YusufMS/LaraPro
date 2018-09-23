<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

use App\Category;
use App\User;
use App\Tag;
use App\Charts\SampleChart;
use Charts;
use DB;
use App\PostTag;
use Alert;

use Auth;

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
        $tags = Tag::all();
        $categories = Category::all();
        
        $posts = Category::find($id)->posts()->where('visibility', 1)->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.blog.blog', compact('posts', 'categories', 'id', 'tags'));
    }

    public function blogByAuthor($id){
        $posts = Post::where('visibility', 1)->where('user_id', $id)->orderBy('created_at', 'desc')->paginate(10);
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

    public function search(Request $request){
        $post_ids = PostTag::select('post_id')->whereIn('tag_id', $request->tags)->get();
        $tags = Tag::all();
        $search_tags = Tag::whereIn('id', $request->tags)->get();
        $tags_count = $search_tags->count();

        $posts = Post::whereIn('id', $post_ids)->paginate(10);
        $loop_count = 0;

        return view('pages.blog.blogBySearch', compact('posts', 'search_tags', 'tags_count', 'loop_count', 'tags'));
    }

    public function dashboard(){
        $posts = Post::where('user_id', Auth::id())->get();
        $posts_chart = Charts::database($posts, 'line', 'highcharts')
                     ->title('Post Details')
                     ->elementLabel('Total Posts')
                     ->dimensions(850, 400)
                     ->responsive(true)
                    //  ->colors(['gray', 'green', 'blue', 'yellow', 'orange', 'cyan', 'magenta'])
                     ->groupByday();


        return view('pages.dashboard.home', compact('posts_chart', 'posts'));
    }

    
}
