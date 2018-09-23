{{-- <strong>Hello {{$mail_info->receiver}}</strong>
<h3 class="lead text-center">A Feedback on your post "{{$mail_info->post_title}}"</h3>
<p>Below message is the feedback provided by {{$mail_info->sender}}</p>
<hr>
<div class="card">
    <div class="card-header">Feedback by {{$mail_info->sender}}</div>
    <div class="card-body">
        <em>"{{$mail_info->feedback}}"</em>
    </div>
</div>
<hr>
<br>
<br>
Thank You,
<br/>
<i>LaraPro</i> --}}

@component('mail::message')
<h2>A Feedback on your post {{$mail_info->post_title}}</h2>
<p>Below message is the feedback provided by {{$mail_info->sender}}</p>

@component('mail::panel')
"{{$mail_info->feedback}}"
@endcomponent

@component('mail::button', ['url'=>'#', 'color'=>'success'])
View Post in Context
@endcomponent

Thank You,<br>
{{ config('app.name') }}
@endcomponent