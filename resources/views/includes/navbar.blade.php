
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
        <a class="navbar-brand" href="/">LaraPro</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            

            
            <ul class="navbar-nav mr-auto py-2">
                @guest
                    <li class="nav-item {!! url()->current() == route('indexPage') ? ' active' : '' !!}">
                        <a class="nav-link" href="{{route('indexPage')}}">Home</a>
                    </li> 
                    </li>
                    <li class="nav-item{!! url()->current() == route('aboutPage') ? ' active' : '' !!}">
                        <a class="nav-link" href="{{route('aboutPage')}}">About</a>
                    </li>
                    </li>
                    <li class="nav-item{!! url()->current() == route('contactPage') ? ' active' : '' !!}">
                        <a class="nav-link" href="{{route('contactPage')}}">Contact</a>
                    </li>
                @else
            
                    <li class="nav-item{!! url()->current() == route('indexPage') ? ' active' : '' !!}">
                        <a class="nav-link" href="{{route('indexPage')}}"><i class="material-icons md-inactive align-middle">home</i> Home</a>
                    </li>
                    <li class="nav-item{!! url()->current() == route('dashboard') ? ' active' : '' !!}">
                        <a class="nav-link" href="{{route('dashboard')}}"><i class="material-icons md-inactive align-middle">dashboard</i> Dashboard</span></a>
                    </li>
                    <li class="nav-item{!! url()->current() == route('blogPage') ? ' active' : '' !!}">
                        <a class="nav-link" href="{{route('blogPage')}}"><i class="material-icons md-inactive align-middle">ballot</i> Blog</a>
                    </li>

                    <li class="nav-item{!! url()->current() == route('profile.index') ? ' active' : '' !!}">
                        <a class="nav-link" href="{{route('profile.index')}}"><i class="material-icons md-inactive align-middle">supervised_user_circle</i> Profiles</a>
                    </li>
                    <li class="nav-item{!! url()->current() == route('aboutPage') ? ' active' : '' !!}">
                        <a class="nav-link" href="{{route('aboutPage')}}"><i class="material-icons md-inactive align-middle">info</i> About</a>
                    </li>
                    {{-- <li class="nav-item{!! url()->current() == route('contactPage') ? ' active' : '' !!}">
                        <a class="nav-link" href="{{route('contactPage')}}"><i class="material-icons md-inactive align-middle">contact_support</i> Contact</a> --}}
                    {{-- <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                    </li> --}}
                @endguest
            </ul>

            
            {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> --}}

            @guest

            @else
            {{-- Notifications --}}
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item dropdown">
                    <a class="nav-link" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons align-middle">notifications</i><span class="small"><sup class="badge badge-pill badge-warning">{{Auth::user()->unreadNotifications->count()}}</sup></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="navbarDropdown">
                        <div class="text-center font-weight-bold">Notifications</div><hr class="my-1">
                        @foreach(Auth::user()->notifications as $notification)
                            @if($notification->read_at == null)
                            <small><a class="dropdown-item" href="{{url('notificationClick/' . $notification->id)}}">
                                <strong>{{App\Comment::find($notification->data['comment_id'])->user->first_name}}</strong>
                                commented on your post
                                <Strong>{{App\Comment::find($notification->data['comment_id'])->post->title}}</Strong><br>
                                "{{str_limit($notification->data['content'], 30 , '...')}}"
                                {{$notification->created_at->diffForHumans()}}
                            </a></small>
                            @else
                            <small><a class="dropdown-item text-muted" href="{{url('notificationClick/' . $notification->id)}}">
                                <strong>{{App\Comment::find($notification->data['comment_id'])->user->first_name}}</strong>
                                commented on your post
                                <Strong>{{App\Comment::find($notification->data['comment_id'])->post->title}}</Strong><br>
                                {{$notification->data['content']}}
                                {{$notification->created_at->diffForHumans()}}
                            </a></small>
                            @endif
                        @endforeach
                        
                    </div>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-right">
                    <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Blog Post
                    </a>
                    <div class="dropdown-menu rounded-0" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{asset('posts/create')}}">Create Post</a>
                        <a class="dropdown-item" href="{{route('posts.index')}}">View Own Posts</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('blogPage')}}">Blog</a>
                    </div>
                    </li>
                </ul>
            @endguest

            {{-- No need after navigatation added to above dropdown
                <ul class="navbar-nav navbar-right">
                <li class="nav-item"><a class="nav-link" href="{{asset('posts/create')}}">Create Post</a></li>
            </ul> --}}



            <ul class="navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a class="dropdown-item" href="{{asset('profile/' . Auth::id())}}">My Profile</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest

                {{-- <li class="nav-item"><a class="nav-link" href="{{asset('login')}}"><span class="glyphicon glyphicon-log-in"></span>Login</a></li> --}}
                {{-- <li class="nav-item"><a class="nav-link" href="{{asset('register')}}"><span class="glyphicon glyphicon-log-in"></span>Register</a></li> --}}
            </ul>
            </div>
      </nav>

    
{{-- <nav class="navbar navbar-inverse navbar-expand-md" style="padding:0px">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-3">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
          </div>
      
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbar-collapse-3">
            <ul class="nav navbar-nav">
                <li class="active"><a class="nav-link" href="{{asset('/')}}">Home</a></li>
                <li><a class="nav-link" href="{{asset('about')}}">About</a></li>
                <li><a class="nav-link" href="{{asset('profile')}}">Profile</a></li>
                <li><a class="nav-link" href="{{asset('contact')}}">Contact</a></li> --}}
                {{-- <li>
                    <a class="btn btn-default btn-outline btn-circle collapsed" style="padding:5px; margin-top:auto; margin-bottom:auto;" data-toggle="collapse" href="#nav-collapse3" aria-expanded="false" aria-controls="nav-collapse3">Search</a>
                </li> --}}
            {{-- </ul>
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul> --}}
            {{-- <div class="collapse nav navbar-nav nav-collapse slide-down" id="nav-collapse3">
              <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search" />
                </div>
                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
              </form>
            </div> --}}
          {{-- </div><!-- /.navbar-collapse -->
      </nav><!-- /.navbar --> --}}
