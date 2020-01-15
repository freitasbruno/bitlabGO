<div class="card item-card bookmark-card" data-id="{{ $item->bookmark->id }}" data-type="bookmarks">
	<div class="bookmark-card-icon">
		@if (isset($item->bookmark->iconUrl))
			<img src="{{ $item->bookmark->iconUrl }}" alt="">	
		@else
			<img src={{ $item->bookmark->url . "/favicon.ico" }} alt="">
		@endif
	</div>
	<div class="card-text">
		<p class="card-text-m">{{ $item->name }}</p>
		<p class="card-text-xs pt-5"><a href="{{ $item->bookmark->url }}" target="_blank">{{ $item->bookmark->url }}</a></p>			
	</div>
</div>