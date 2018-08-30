@extends('includes.layout')

@section('content')
    {{-- fix everything in container div --}}
<div class="container">
<h1 class="text-center font-weight-normal">Dashboard</h1>
<div>
    Total Posts : {{$posts->count()}} <br>
    Total views for your posts : {{$posts->sum('view_count')}}
    {!! $posts_chart->html() !!}
    
</div>
</div>

{!! Charts::scripts() !!}
{!! $posts_chart->script() !!}
@endsection