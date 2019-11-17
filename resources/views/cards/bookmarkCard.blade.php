<div class="card mb-2">
	<div class="d-flex justify-content-between p-2">
		<div class="col-sm-10 text-truncate p-0">
			<a href="{{ $item->bookmark->url }}" target="_blank">{{ $item->name }}</a>			
		</div>
		@component('components/itemTools')
		{{ 'bookmarks/' . $item->id }}
		@endcomponent
	</div>
</div>