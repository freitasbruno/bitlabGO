<div class="card item-card bookmark-card" data-id="{{ $item->bookmark->id }}" data-type="bookmarks">
	<img src="https://via.placeholder.com/100" alt="">
	<div class="card-text">
		<p class="card-text-m">{{ $item->name }}</p>
		<p class="card-text-xs pt-5"><a href="{{ $item->bookmark->url }}" target="_blank">{{ $item->bookmark->url }}</a></p>			
	</div>
</div>