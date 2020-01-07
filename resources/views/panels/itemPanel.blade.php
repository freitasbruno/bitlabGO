<div class="card-deck">
	<div class="deck-title">
		<div class="filter">
			<i class="material-icons item-filter-link {{ $itemType == 'cash' ? 'selected' : ''}}" data-url="cash">attach_money</i>					
			<i class="material-icons item-filter-link {{ $itemType == 'task' ? 'selected' : ''}}" data-url="tasks">done</i>					
			<i class="material-icons item-filter-link {{ $itemType == 'timer' ? 'selected' : ''}}" data-url="timers">timer</i>					
			<i class="material-icons item-filter-link {{ $itemType == 'bookmark' ? 'selected' : ''}}" data-url="bookmarks">bookmark_border</i>
		</div>
		<div class="deck-title-text">
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