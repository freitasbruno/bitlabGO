<div class="item-card bookmark-card" data-id="{{ $bookmark->id }}" data-type="bookmarks">
	<div class="bookmark-card-grid">
		<img src="https://via.placeholder.com/100" alt="">
		<div class="card-text">
			<p class="card-text-m">{{ $bookmark->item->name }}</p>
			<p class="card-text-xs pt-5"><a href="{{ $bookmark->url }}" target="_blank">{{ $bookmark->url }}</a></p>			
		</div>
	</div>
</div>