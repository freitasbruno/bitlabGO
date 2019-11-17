@extends('layouts.app')

@section('content')
<div class="container">

	<form action="/cash/{{ $cash->id }}" method="POST">
		@csrf
		@method('PUT')
		@include('forms.cashForm', ['item' => $item, 'cashItem' => $cash, 'accounts' => $accounts])
		<div class="text-center">
			<a class="btn btn-secondary" href="/home/{{ session('currentGroup')->id ?? null }}" role="button">Close</a>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>

</div>
@endsection