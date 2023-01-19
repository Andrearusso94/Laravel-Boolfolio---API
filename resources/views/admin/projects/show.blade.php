@extends('layouts.admin')

@section('content')

<h1>{{$project->title}}</h1>
<h4>{{$project->type ? $project->type->name : 'undefined'}}</h4>
<h5>{{$project->slug}}</h5>
<div class="content">
    <p>{{$project->body}}</p>

    @if(count($project->technologys) > 0)

    @foreach($project->technologys as $technology)
    <p>{{$technology->name}}</p>
    @endforeach

    @else
    <span>not technology</span>
    @endif
</div>


@endsection