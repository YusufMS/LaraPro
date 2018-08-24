<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}"> 

        {{-- Scripts --}}
        <link href="{{asset('js/app.js')}}">

        {{-- Imported for icons --}}
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> {{-- socialmedia link icons --}}


        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script> {{-- imported for tooltip styling --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        


        <title>{{config('app.name', 'Larapro')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        {{-- styles --}}
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/custom.css')}}" rel="stylesheet">

        <style>
                /* Remove the navbar's default margin-bottom and rounded borders */ 
                .navbar {
                  margin-bottom: 0;
                  border-radius: 0;
                }
                
                /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
                .row.content {height: 450px}
                
                /* Set gray background color and 100% height */
                .sidenav {
                  padding-top: 20px;
                  background-color: #f1f1f1;
                  height: 100%;
                }
                
                /* Set black background color, white text and some padding */
                footer {
                  background-color: #555;
                  color: white;
                  padding: 15px;
                }
                
                /* On small screens, set height to 'auto' for sidenav and grid */
                @media screen and (max-width: 767px) {
                  .sidenav {
                    height: auto;
                    padding: 15px;
                  }
                  .row.content {height:auto;} 
                }
                .material-icons.md-18 { font-size: 18px; }

                .material-icons.md-dark { color: rgba(0, 0, 0, 0.54); }
                .material-icons.md-dark.md-inactive { color: rgba(0, 0, 0, 0.26); }

                .material-icons.md-light { color: rgba(255, 255, 255, 1); }
                .material-icons.md-light.md-inactive { color: rgba(255, 255, 255, 0.3); }

                .fa {
                    padding: 5px;
                    font-size: 20px;
                    width: 30px;
                    /* border-radius: 50%; */
                    text-align: center;
                    text-decoration: none;
                }
                
              </style>
              

    </head>
    <body>
        @include('includes.navbar')
        
        <div class="container-fluid text-center">   
            <div class="row content">
                @guest
                    <div class="col-sm-10 text-left"> 
                        <br>
                        @include('includes.messages')
                        @yield('content')
                        <br>
                    </div>
                    @include('includes.sidebarRight')
                @else
                    @include('includes.sidebarLeft')

                    <div class="col-sm-8 text-left"> 
                        <br>
                        @include('includes.messages')
                        @yield('content')
                        <br>
                    </div>
                    @include('includes.sidebarRight')
                @endguest
                
                
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
            </script>
        {{-- <footer class="container-fluid text-center">
            <p>Footer Text</p>
        </footer> --}}
        
    </body>
</html>
