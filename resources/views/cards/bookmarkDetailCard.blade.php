<div class="container" data-id="{{ $item->bookmark->id }}" data-type="bookmarks">

	<div class="bookmark-card-grid">
		<img src="https://via.placeholder.com/100" alt="">
		<div class="card-text">
			<p class="card-text-m editable" data-field="name">{{ $item->name }}</p>
			<p class="card-text-xs pt-5"><a href="{{ $item->bookmark->url }}" target="_blank">{{ $item->bookmark->url }}</a></p>			
		</div>
	</div>
	<div class="main-card-detail-grid">
		<div></div>
		@if ($item->description)		
			<p class="card-text-xs editable" data-field="description">{{ $item->description }}</p>
		@else
			<p class="card-text-xs editable" data-field="description">Enter a description...</p>
		@endif
	</div>

	@include('cards.itemCardDetails', ['item' => $item])
	
</div>