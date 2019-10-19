@extends('layouts.app')

@section('content')
<div class="container">

	<form action="/cashItems/{{ $item->id }}" method="POST">
		@csrf
		@method('PUT')
		@include('includes.cashItemForm', ['item' => $item])
		<div class="text-center">
			<a class="btn btn-secondary" href="/home/{{ session('currentGroup')->id ?? null }}" role="button">Close</a>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>

</div>
@endsection