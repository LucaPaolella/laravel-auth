@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-4 text-secondary my-4">
            Lista dei post
        </h2>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Crea Post</a>
    </div>
    @include('partials.message')
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>@if($post->image) <a href="#" class="btn btn-sm btn-secondary">image</a> @endif {{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td>
                    <ul class="list-unstyled d-flex m-0 gap-1 justify-content-end">
                        <li><a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-primary">Show</a></li>
                        <li><a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a></li>
                        <li><a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#post-{{ $post->id }}">Delete</a>
                            {{-- <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                            </form> --}}


                        </li>
                    </ul>


                </td>
              </tr>

              <div class="modal fade" id="post-{{ $post->id }}" tabindex="-1"  aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Attenzione</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler cancellare il post con id <strong>{{ $post->id }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>



            @endforeach
        </tbody>
      </table>
</div>
@endsection