@extends('layouts')

@section('content')
  
  <h1 class="title">Projects</h1>
  @if (session('success'))
    <div class="notification is-success">
      {{ session('success') }}
    </div>
  @endif
  <ul>
    @foreach ($projects as $project)
        <li>
          <a href="/projects/{{ $project->id }}">{{ $project->title }}</a>
        </li>
    @endforeach
  </ul>
@endsection