<div class="container" data-id="{{ $item->bookmark->id }}" data-type="bookmark">

	<div class="bookmark-card-grid">
		<img src="https://via.placeholder.com/100" alt="">
		<div class="card-text">
			<p class="card-text-m">{{ $item->name }}</p>
			<p class="card-text-xs pt-5"><a href="{{ $item->bookmark->url }}" target="_blank">{{ $item->bookmark->url }}</a></p>			
		</div>
	</div>
	<div class="main-card-detail-grid">
		<div></div>
		<div>
			<p class="card-text-xs">{{ $item->description }}</p>
		</div>
	</div>

	@include('cards.itemCardDetails', ['item' => $item])
	
</div>