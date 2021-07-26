@extends('layout')

@section('content')

<div class="container">
<div class="card card-body bg-light p-4">
<form action="{{ route('posts.update', $posts->id ) }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" class="form-control" name="title" id="title" value="{{ $posts->title }}" placeholder="Add Title">
	</div>
  
  @error('title')
    <div class="text-danger">{{ $message }}</div>
  @enderror
  
    <div class="form-group">
		<label for="description">Description</label>
		<textarea class="form-control" name="description" id="description" rows="3">{{ $posts->description }}</textarea>
	</div>
	
	@error('description')
		<div class="text-danger">{{ $message }}</div>
	@enderror
	
	<div class="form-group">
		<label for="image">Image</label>
		@if($posts->image !="")
		<div><img src="{{ asset('storage/images/'.$posts->image) }}" width="100" height="100"></div>
		@endif
		<input type="file" class="form-control" name="image" id="image">
	</div>
	
	@error('image')
		<div class="text-danger">{{ $message }}</div>
	@enderror
  
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="/posts" ><div class="btn btn-primary">Cancel</div></a>
</form>
</div>
</div>

@endsection