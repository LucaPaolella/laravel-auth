@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifica post: {{ $post->title }}</h2>
    @include('partials.errors')
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="form-input-image">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea class="form-control" id="content" name="content">{{ old('content', $post->content) }}</textarea>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="set_image" name="set_image" value="1" @if($post->image) checked @endif>
            <label class="form-check-label" for="set_image">Attiva per gestire immage (da rivedere)</label>
          </div>
        <div class="mb-3 @if(!$post->image) d-none @endif"  id="image-input-container">
            <!-- anteprima immagine upload -->
            <div class="preview">
                <img id="file-image-preview" @if($post->image) src="{{ asset('storage/' . $post->image) }}" @endif>
            </div>
            <!-- /anteprima immagine upload -->

            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
      </form>

</div>
@endsection