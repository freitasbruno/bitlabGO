<div class="card uk-card uk-card-hover">

	<!-- CARD BODY -->
	<div class="uk-grid">
		<p class="uk-width-expand uk-text-truncate">{{ $item->name }}</p>
		
		<div class="uk-width-auto">
			@component('components/itemTools')
			{{ 'bookmarks/' . $item->bookmark->id }}
			@endcomponent
		</div>
	</div>
	<div class="uk-grid">
		<div class="uk-width-auto card-link">Link: </div>
		<a class="uk-width-expand uk-text-truncate" href="{{ $item->bookmark->url }}">{{ $item->bookmark->url }}</a>
	</div>
	<!-- CARD BODY -->

</div>