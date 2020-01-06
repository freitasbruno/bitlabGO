<div class="container" data-id="{{ $item->cash->id }}" data-type="cash">

	<div class="main-card-detail-grid">
		<div>
			@if ($item->cash -> type == 'expense')					
				<span class="icon-expense">
					<img class="icon-25" src="/images/prototype/cash-arrow-down.svg" alt="Expense"></a>
				</span>				
			@else
			<span class="icon-income">
				<img class="icon-25" src="/images/prototype/cash-arrow-up.svg" alt="Income"></a>
			</span>					
			@endif
		</div>
		<div>
			<p class="card-text-l editable" data-field="amount">€{{ $item->cash->amount }}</p>
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
		<p class="card-text-s">{{ $item->cash->account->group->name }}</p>
	</div>

	@include('cards.itemCardDetails', ['item' => $item])
	
</div>