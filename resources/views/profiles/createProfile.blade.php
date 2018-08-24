@extends('includes.layout')
@section('content')
<h1>Add Details to your Profile</h1>
<br>

{{Form::open(['action' => 'ProfileController@store', 'method' => 'POST', 'files' => true])}}

    <div class="form-group">
        <label for="bio">A Bio for your profile</label>
        <textarea type="text" name="bio" id="bio" class="form-control"></textarea>
        <small class="form-text text-muted">Bio is used as an introduction to your profile to be shown to other moderators and users</small>
    </div>
    <div class="form-group">
        <label for="contact_no">Contact Number<sup>*</sup></label>
        <input type="text" name="contact_no" id="contact_no" class="form-control" placeholder="081XXXXXXX">
        <small class="form-text text-muted">Input should a number and should contain 10 <strong>digits</strong></small>
    </div>
    <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" id="dob" class="form-control">
    </div>
    <div class="form-group">
        <label for="occupation">Current Profession / Occupation</label>
        <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Eg: Sofware Engineer">
    </div>
    <div class="form-group">
        <label for="qualification">Qualification</label>
        <input type="text" name="qualification" id="qualification" class="form-control" placeholder="Eg: B.Sc in Information Systems">
    </div>
    <div class="form-group">
        <label for="interest">Interests</label>
        <input type="text" name="interest" id="interest" class="form-control" placeholder="Your interested topics and ares. Eg: Web Developent, Electronics">
        <small class="form-text text-muted">Seperate multiple interests with a comma</small>
    </div>
    <div class="form-group">
        <label for="">Gender</label>
        <div class="custom-control custom-radio">
            <input type="radio" name="gender" id="male" value=1 class="custom-control-input">
            <label for="male" name="gender" class="custom-control-label">Male</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" name="gender" id="female" value=0 class="custom-control-input">
            <label for="female" name="gender" class="custom-control-label">Female</label>
        </div>
    </div>
    <div class="form-group">
        <label for="from">Where are you from</label>
        <input type="text" id="from" name="from" class="form-control" placeholder="Eg: Kandy">
    </div>
    <div class="form-group">
        <label for="living_in">Where do you live now</label>
        <input type="text" id="living_in" name="living_in" class="form-control" placeholder="Eg: Colombo">
    </div>

    <div class="form-group">
        <label for="from">Social Media links to contact you</label>

        <div class="input-group my-2">
            <div class="input-group-prepend">
                <span class="input-group-text p-0"><span class="fa fa-facebook p-2 ml-0" ></span></span>
            </div>
            <input type="text" id="from" name="facebook" class="form-control" placeholder="Facebook">
        </div>

        <div class="input-group my-2">
            <div class="input-group-prepend">
                <span class="input-group-text p-0"><span class="fa fa-linkedin p-2 ml-0" ></span></span>
            </div>
            <input type="text" id="from" name="linked_in" class="form-control" placeholder="LinkedIn">
        </div>

        <div class="input-group my-2">
            <div class="input-group-prepend">
                <span class="input-group-text p-0"><span class="fa fa-twitter p-2 ml-0" ></span></span>
            </div>
            <input type="text" id="from" name="twitter" class="form-control" placeholder="Twitter">
        </div>

        <div class="input-group my-2">
            <div class="input-group-prepend">
                <span class="input-group-text p-0"><span class="fa fa-youtube p-2 ml-0" ></span></span>
            </div>
            <input type="text" id="from" name="youtube" class="form-control" placeholder="Youtube">
        </div>

    </div>

    <div class="form-group">
        <label>Do you want people to see your E-Mail Address</label>
        <div class="custom-control custom-radio">
            <input type="radio" name="show_mail" value=1 id="yes" class="custom-control-input">
            <label for="yes" class="custom-control-label">Yes</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" name="show_mail" value=0 id="no" class="custom-control-input">
            <label for="no" class="custom-control-label">No</label>
        </div>
        <small class="form-text text-muted">Your mail address is shared with others by default unless specified otherwise</small>       
    </div>
    <div class="form-group">
        <label for="">Profile Photo</label>
        <div class="custom-file">
            <input type="file" name="profile_photo" id="profileImage" class="custom-file-input">
            <label for="profileImage" class="custom-file-label">Add a <strong>Profile Photo</strong> so that people could identify you..</label>
        </div>
        <small class="form-text text-muted">The image uploaded should not be larger than 2 megabytes</small>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success float-right my-2 mr-2">Done</button>
        <button type="reset" class="btn btn-danger float-right my-2 mr-2">Reset</button>
    </div>
    
{{Form::close()}}


@endsection