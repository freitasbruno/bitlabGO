<div class="container" data-id="{{ $cash->id }}" data-type="cash">

	<div class="main-card-detail-grid">
		<div>
			@if ($cash -> type == 'expense')					
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
			<p class="card-text-l">€{{ $cash->amount }}</p>
		</div>
		<div></div>
		<div>
			<p class="card-text-s">{{ $cash->item->name }}</p>	
			<br>		
			<p class="card-text-s">{{ $cash->account->group->name }}</p>
			<p class="card-text-xs">{{ $cash->item->description }}</p>
		</div>
	</div>

	@include('cards.cardDetails', ['item' => $cash->item])
	
</div>