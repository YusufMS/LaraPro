@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">{{ $error }} <button type="button" class="close" data-dismiss="alert">&times;</button></div>
        @endforeach
    </div>
@endif

@if (session('success'))
    <div class = "alert alert-success alert-dismissible">
        {{session('success')}}<button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

@if (session('error'))
    <div class = "alert alert-danger alert-dismissible">
        {{session('error')}}<button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif