@extends('layout')

@section('content')
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Post Title</th>
      <th scope="col">Post Description</th>
	  <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  
  <tbody>
  @foreach($posts as $post)
    <tr>
      <th scope="row">{{ $post->id }}</th>
      <td>{{ $post->title }}</td>
      <td>{{ $post->description }}</td>
	  <td><img src="{{ asset('storage/images/'.$post->image) }}" width="100" height="100"></td>
      <td>
		<a href="{{ route('posts.edit', $post->id )}}" class="btn btn-success">Edit</a>
		<!--<a href="{{ route('posts.destroy', $post->id ) }}" class="btn btn-danger">Delete</a>-->
		<form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete ?')">
			@csrf
			@method('DELETE')
			<button type="submit" class="btn btn-danger">Delete</button>
		</form>
	  </td>
    </tr>
	@endforeach
    
  </tbody>
</table>
	
	
@endsection