<div class="container" data-id="{{ $bookmark->id }}" data-type="bookmark">

	<div class="bookmark-card-grid">
		<img src="https://via.placeholder.com/100" alt="">
		<div class="card-text">
			<p class="card-text-m">{{ $bookmark->item->name }}</p>
			<p class="card-text-xs pt-5"><a href="{{ $bookmark->url }}" target="_blank">{{ $bookmark->url }}</a></p>			
		</div>
	</div>
	<div class="main-card-detail-grid">
		<div></div>
		<div>
			<p class="card-text-xs">{{ $bookmark->item->description }}</p>
		</div>
	</div>

	@include('cards.cardDetails', ['item' => $bookmark->item])
	
</div>