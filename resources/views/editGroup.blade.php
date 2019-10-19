@extends('layouts.app')

@section('content')
<div class="container">

	<form action="/home/{{ $group->id }}" method="POST">
		@csrf
		@method('PUT')
		@include('includes.groupForm', ['item' => $group])
		<div class="text-center">
			<a class="btn btn-secondary" href="/home/{{ session('currentGroup')->id ?? null }}" role="button">Close</a>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>

</div>
@endsection