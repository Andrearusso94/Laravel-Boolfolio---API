@extends('layouts.admin')
@section('content')

<h1>Crea Nuovo Prodotto</h1>
<!--@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif-->
<form action="{{route('admin.project.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" value="{{old('title')}}" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small>
    </div>
    @error('title')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror
    <div class="mb-3">
        <label for="type_id" class="form-label">Types</label>
        <select class="form-select form-select-lg" name="type_id" id="type_id">
            <option selected>Select one</option>
            @foreach($type as $type)
            <option value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="technology" class="form-label">Technology</label>
        <select multiple class="form-select form-select-lg" name="technology[]" id="technology">
            <option value="" disabled>Select Technology</option>
            @forelse ($technology as $technology)
            @if($errors->any())
            <option value="{{$technology->id}}" {{in_array($technology->id, old('technology', [])) ? 'selected' : ''}}>{{$technology->name}}</option>
            @else
            <option value="{{$technology->id}}">{{$technology->name}}</option>
            @endif
            @empty
            <option>No technology</option>
            @endforelse
        </select>
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" value="{{old('slug')}}" name="slug" id="slug" class="form-control" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small>
    </div>

    <div class="mb-3">
        <label for="cover_image" class="form-label">Cover Image</label>
        <input type="file" name="cover_image" id="cover_image" class="form-control" placeholder="" aria-describedby="coverimagehelper">
        <small id="coverimagehelper" class="text-muted">Help text</small>
    </div>
    @error('cover_image')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror
    <div class="mb-3">
        <label for="body" class="form-label">Descrizione</label>
        <input type="text" value="{{old('body')}}" name="body" id="body" class="form-control" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small>
    </div>

    <button type="submit" class="btn btn-primary">Crea</button>
</form>
@endsection