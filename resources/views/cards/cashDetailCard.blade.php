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
			<p class="card-text-l">€{{ $item->cash->amount }}</p>
		</div>
		<div></div>
		<div>
			<p class="card-text-s">{{ $item->name }}</p>	
			<br>		
			<p class="card-text-s">{{ $item->cash->account->group->name }}</p>
			<p class="card-text-xs">{{ $item->description }}</p>
		</div>
	</div>

	@include('cards.itemCardDetails', ['item' => $item])
	
</div>