<!-- /resources/views/components/itemTools.blade.php -->

<div class="btn-group">
	<form method="post" action="/{{ $slot }}/edit">
		@csrf
		@method('GET')
		<button type="submit" class="btn btn-link p-0"><i class="far fa-edit dark"></i></button>
	</form>
	<form method="post" action="/{{ $slot }}">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-link p-0"><i class="far fa-trash-alt dark"></i></button>
	</form>
</div>