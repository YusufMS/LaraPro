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
        $posts = Post::where('visibility', 1)->orderBy('created_at', 'desc')->paginate(02);
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

    public function search(Request $request){
        
        // // return $request;
        // return DB::select('select posts.id,tags.id from posts,tags where posts.id=tags.id', [1]);
        // $tags_array = array();
        // // foreach($request->tags as $tag_id){
        // //     Tag::find($tag_id)->post
        // // }

        // $post_id_array = array();
        // foreach ($request->tags as $tag){
        //     if(!in_array(Tag::find($tag)->post[0]->id, $post_id_array)){
        //         array_push($post_id_array, Tag::find($tag)->post[0]->id);
        //     }
            
        //     // dd($x);
        //     // foreach ($tag->post as $tag_post){
        //     //     array_add($post_id_array, $tag_post->id , $tag_post->id);
        //     // };
        // }
        // dd($post_id_array);
        // $post = Post::where('id', $post_id_array)->get();
        // dd($post);
        
        // $posts = Post::all();

        // // return $request;
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
