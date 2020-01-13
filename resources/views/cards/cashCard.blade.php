<div class="card item-card cash-card" data-id="{{ $item->cash->id }}" data-type="cash">
	<div>
		@if ($item->cash -> type == 'expense')					
			<span class="icon-expense">
				<img class="icon-25" src="/images/prototype/cash-arrow-down.svg" alt="Expense"></a>
			</span>				
		@else
		<span class="icon-income">
			<img class="icon-25" src="/images/prototype/cash-arrow-up.svg" alt=Income"></a>
		</span>					
		@endif
	</div>
	<div>
		<p class="card-text-l">€{{ $item->cash->amount }}</p>
	</div>
	<div></div>
	<div>			
		<p class="card-text-s">{{ $item->name }}</p>
		<p class="card-text-xs pt-5"><time datetime="2016-04-01T19:00">{{ $item->cash->created_at }}</time></p>
	</div>
</div>