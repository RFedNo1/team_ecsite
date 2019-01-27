@extends('layouts')

@section('content')
    <h1 class="title">Edit Project</h1>

    <form action="/projects/{{ $project->id }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="field">
        <label class="label" for="title">Title</label>
          <div class="control">
            <input type="text" class="input" name="title" placeholder="Title" value="{{$project->title}}">
          </div>
      </div>
      <div class="field">
        <label class="label" for="">Description</label>
        <div class="control">
          <textarea name="description" class="textarea" id="" cols="30" rows="10">{{$project->description}}</textarea>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <button type="submit" class="button is-link">Update Project</button>
        </div>
      </div>
    </form>
    <form action="/projects/{{ $project->id }}" method="POST">
      @csrf
      @method('DELETE')
      <div class="field">
        <div class="control">
          <button type="submit" class="button is-danger">Delete Project</button>
        </div>
      </div>
    </form>
@endsection