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
			<p class="card-text-xs">{{ $cash->item->description }}</p>
		</div>
	</div>

	<div class="card-detail-grid">
		<div></div>
		<p class="card-text-xs"><time datetime="2016-04-01T19:00">{{ $cash->created_at }}</time></p>

		<img class="icon-25" src="/images/prototype/icon.svg" alt="Expense"></a>
		<p class="card-text-s">
			<span class="card-tag">HOUSE</span>
			<span class="card-tag">ESTORIL</span>
		</p>

		<img class="icon-25" src="/images/prototype/icon.svg" alt="Expense"></a>
		<p class="card-text-s">
			<span class="card-avatar"><img class="icon-25" src="/images/prototype/boy.svg" alt=""></a></span>
			<span class="card-avatar"><img class="icon-25" src="/images/prototype/girl.svg" alt=""></a></span>
		</p>
	</div>

</div>