<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Post;

class ProfileController extends Controller
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
        $profiles = User::all()->except(Auth::id());
        
        return view('profiles.profileIndex', compact('profiles', 'profile_photo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.createProfile');
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
            'bio' => 'max:500',
            'contact_no' => 'digits:10|required',
            'occupation' => 'max:255',
            'dob' => 'date|nullable', //add a before constraint
            'qualification' => 'max:255',
            'interest' => 'max:255',
            'gender' => 'boolean|nullable',
            'from' => 'max:100',
            'living_in' => 'max:100',
            'facebook' => 'url|nullable',
            'linked_in' => 'url|nullable',
            'twitter' => 'url|nullable',
            'youtube' => 'url|nullable',
            'show_mail' => 'boolean|nullable',
            'profile_photo' => 'image|nullable|max:1999',
        ]);

        $social_media = ['fb' => $request->facebook, 'li' => $request->linked_in, 'tw' => $request->twitter, 'yo' => $request->youtube];
        $social_media = serialize($social_media);
        // return $social_media;
        // $social_media = implode(', ', array_filter($social_media));
        

        $user = User::find(Auth::id());
        $user->bio = $request->bio;
        $user->contactNo = $request->contact_no;
        $user->occupation = $request->occupation;
        $user->dob = $request->dob;
        $user->qualifications = $request->qualification;
        $user->interests = $request->interest;
        $user->sex = $request->gender;
        $user->from = $request->from;
        $user->livesIn = $request->living_in;
        $user->socialMediaLinks = $social_media;
        $user->emailVisibility = $request->show_mail;   
        
        if ($request->hasFile('profile_photo')){
            $profile_photo = $request->profile_photo;

            $filename_with_ext = $profile_photo->getClientOriginalName();
            $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
            $extension = $request->file('profile_photo')->getClientOriginalExtension();

            $filename_to_store = 'PP_' . time() . '_' . $filename . '.' . $extension;
            
            $user->profileImage = $filename_to_store;
            Storage::disk('local')->putFileAs('public/images/profilePhoto', $profile_photo, $filename_to_store);
        } else {
            $user->profileImage = 'PP_not_available.jpg';
        }
        
        $user->save();
        return redirect ('/')->with('success', 'Profile Info successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = User::find($id);
        $social_media = unserialize($profile->socialMediaLinks);
        if($id != Auth::id()){
            $profile->view_count = $profile->view_count + 1;
            $profile->save();
        }
        return view('profiles.showProfile', compact(['profile', 'social_media']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = User::find($id);
        $social_media = unserialize($profile->socialMediaLinks);
        return view('profiles.editProfile', compact(['profile', 'social_media']));
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
        return 'Update controller activated'. $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $posts_by_user = Post::where('user_id', $user->id);
        $posts_by_user->delete();

        $comments_by_user = $user->comments;
        $comments_by_user->delete();

        if($user->profileImage != 'PP_not_available.jpg'){
            Storage::delete('public/images/profilePhoto/' . $user->profileImage);
        }
        $user->delete();
        return redirect ('login');
    }
}
