{{-- ITEM NAV --}}
<div id="item-nav">
	<div class="nav-left">
		<i class="material-icons icon-btn item-filter-link white {{ $type == 'cash' ? 'selected' : ''}}" data-type="cash">attach_money</i>					
		<i class="material-icons icon-btn item-filter-link white {{ $type == 'tasks' ? 'selected' : ''}}" data-type="tasks">done</i>					
		<i class="material-icons icon-btn item-filter-link white {{ $type == 'timers' ? 'selected' : ''}}" data-type="timers">timer</i>					
		<i class="material-icons icon-btn item-filter-link white {{ $type == 'bookmarks' ? 'selected' : ''}}" data-type="bookmarks">bookmark_border</i>
	</div>
	<div class="nav-center">
		{{ $title }}
	</div>
	<div class="nav-right">
		<a href="#" class="newItemBtn" data-type="{{ $type }}">
			<i class="material-icons icon-btn white">add_circle</i>
		</a>
	</div>
</div>

{{-- CARD CONTAINER --}}
@if ($items->count() > 0)
	@if(isset($totals) && $totals['type'] == 'cash')
		<div class="item-totals">
			<div class="card white-card totals-card">
				<p class="card-text-s">Income:</p>
				<p class="card-text-m">{{ $totals['income'] }}€</p>
			</div>
			<div class="card white-card totals-card">
				<p class="card-text-s">Expenses:</p>
				<p class="card-text-m">{{ $totals['expense'] }}€</p>
			</div>
			<div class="card white-card totals-card">
				<p class="card-text-s">Balance:</p>
				<p class="card-text-m">{{ $totals['balance'] }}€</p>
			</div>			
		</div>
	@endif
@endif

@if(isset($totals) && $totals['type'] == 'cash')
	<div class="totals card-container">
@else
	<div class="card-container">
@endif
	<div class="cardScrollbar">
		@include('forms.formCard', ['type' => $type, 'formName' => rtrim($type,'s') . 'Form', 'accounts' => $accounts ?? null])
		@if ($items->count() > 0)
			@each('cards.' . rtrim($type,'s') . 'Card', $items, 'item')
		@else
			<p class="card-text-s">There are no {{ $type }} on this group</p>
		@endif
	</div>
	<div class="force-overflow"></div>
</div>