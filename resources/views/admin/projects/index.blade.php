@extends('layouts.admin')

@section('content')

@if(session('message'))
<div class="alert alert-success">
    {{session('message')}}
</div>
@endif

<div class="table-responsive">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col"><a name="" id="" class="btn btn-primary" href="{{route('admin.project.create')}}" role="button">Crea</a></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($project as $proje)
            <tr class="">
                <td scope="row">{{$proje->id}}</td>
                <td>{{$proje->title}}</td>
                <td>{{$proje->slug}}</td>
                <td>
                    <div class="d-flex px-1">



                        <a name="" id="" class="btn mx-1 btn-primary" href="{{route('admin.project.edit', $proje->slug)}}" role="button">Modifica</a>
                        <a name="" id="" class="btn mx-1 btn-primary" href="{{route('admin.project.show', $proje->slug)}}" role="button">Visualizza</a>
                        <form action="{{route('admin.project.destroy', $proje->slug)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td>
                    No Project
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>



@endsection