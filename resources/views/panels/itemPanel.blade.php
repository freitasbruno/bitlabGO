<div class="card-deck">
	<div class="deck-title">
		<div class="deck-title-text">
			{{-- <i class="material-icons filter-link" data-url="cash">attach_money</i>					
			<i class="material-icons filter-link" data-url="tasks">done</i>					
			<i class="material-icons filter-link" data-url="timers">timer</i>					
			<i class="material-icons filter-link" data-url="bookmarks">bookmark_border</i> --}}
			{{ $title }}
		</div>
		<div class="deck-title-btn">
		<a href="#" class="newItemBtn" data-type="{{ $itemType == 'cash' ? $itemType : $itemType . 's' }}">
				<i class="material-icons">add_circle</i>
			</a>
		</div>
	</div>
	<div class="cardScrollbar">
		<div class="card-container">
			@if ($items->count() > 0)
				@each('cards.' . $itemType . 'Card', $items, 'item')
			@else
				<p class="card-text-s">There are no {{ $itemType }} on this group</p>
			@endif
		</div>
		<div class="force-overflow"></div>	
	</div>
</div>