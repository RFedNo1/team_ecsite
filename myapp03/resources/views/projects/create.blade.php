@extends('layouts')

@section('content')
<h1>Create Project</h1>
  <form action="/projects" method="POST">
    {{ csrf_field() }}
    <div>
    <input type="text" name="title" placeholder="Project title" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" value="{{ old('title') }}">
    </div>
    <div>
      <textarea name="description" placeholder="Project description" class="textarea {{ $errors->has('description') ? 'is-danger' : '' }}">{{ old('description') }}</textarea>
    </div>
    <div>
      <button type="submit" class="button is-link">Create Project</button>
    </div>
  </form>
  @if ($errors->any())
    <div class="notification is-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>  
        @endforeach
      </ul> 
    </div>
  @endif
@endsection