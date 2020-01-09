<div class="card-deck">
	<div class="deck-title">
		<div class="filter">
			<i class="material-icons item-filter-link white {{ $type == 'cash' ? 'selected' : ''}}" data-url="cash">attach_money</i>					
			<i class="material-icons item-filter-link white {{ $type == 'tasks' ? 'selected' : ''}}" data-url="tasks">done</i>					
			<i class="material-icons item-filter-link white {{ $type == 'timers' ? 'selected' : ''}}" data-url="timers">timer</i>					
			<i class="material-icons item-filter-link white {{ $type == 'bookmarks' ? 'selected' : ''}}" data-url="bookmarks">bookmark_border</i>
		</div>
		<div class="deck-title-text">
			{{ $title }}
		</div>
		<div class="deck-title-btn">
			<a href="#" class="newItemBtn" data-type="{{ $type }}">
				<i class="material-icons white">add_circle</i>
			</a>
		</div>
	</div>
	@if ($items->count() > 0)
	<div class="deck-totals">
		@if(isset($totals) && $totals['type'] == 'cash')
			<div class="item-card total-card">
				<p class="card-text-s">Income:</p>
				<p class="card-text-m">{{ $totals['income'] }}€</p>
			</div>
			<div class="item-card total-card">
				<p class="card-text-s">Expenses:</p>
				<p class="card-text-m">{{ $totals['expense'] }}€</p>
			</div>
			<div class="item-card total-card">
				<p class="card-text-s">Balance:</p>
				<p class="card-text-m">{{ $totals['balance'] }}€</p>
			</div>			
		@endif
	</div>
	@endif
	<div class="cardScrollbar">
		<div class="card-container">

			@include('forms.formCard', ['type' => $type, 'formName' => rtrim($type,'s') . 'Form', 'accounts' => $accounts ?? null])
			@if ($items->count() > 0)
				@each('cards.' . rtrim($type,'s') . 'Card', $items, 'item')
			@else
				<p class="card-text-s">There are no {{ $type }} on this group</p>
			@endif
		</div>
		<div class="force-overflow"></div>	
	</div>
</div>