<div class="card mb-2">
	<div class="card-body d-flex justify-content-between">
		<p class="m-0">{{ $item->name }}</p>
		@component('components/itemTools')
			{{ 'tasks/' . $item->id }}
		@endcomponent
	</div>
</div>
