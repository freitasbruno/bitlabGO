<div class="container" data-id="{{ $item->cash->id }}" data-type="cash">

	<div class="card-detail-grid">
		@if ($item->cash -> type == 'expense')					
			<i class="material-icons icon-36 icon-expense">arrow_upward</i>
		@else
			<i class="material-icons icon-36 icon-income">arrow_downward</i>
		@endif
		<div>
			<p class="card-text-l editable">€{{ $item->cash->amount }}</p>
		</div>
		<div></div>
		<div>
			<p class="card-text-s editable" data-field="name">{{ $item->name }}</p>	
			<br>
			@if ($item->description)		
				<p class="card-text-xs editable" data-field="description">{{ $item->description }}</p>
			@else
				<p class="card-text-xs editable" data-field="description">Enter a description...</p>
			@endif
			<br>
		</div>
		<i class="material-icons-outlined">credit_card</i>
		<div>
			<p class="card-text-s" data-field="acoount">{{ $item->cash->account->group->name }}</p>
		</div>
		
		@include('cards.itemCardDetails', ['item' => $item])
	</div>
	
</div>