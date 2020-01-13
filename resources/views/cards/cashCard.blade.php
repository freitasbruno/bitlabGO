<div class="card item-card cash-card" data-id="{{ $item->cash->id }}" data-type="cash">
	@if ($item->cash -> type == 'expense')					
		<i class="material-icons icon-36 icon-expense">arrow_upward</i>
	@else
		<i class="material-icons icon-36 icon-income">arrow_downward</i>
	@endif
	<div>
		<p class="card-text-l">€{{ $item->cash->amount }}</p>
	</div>
	<div></div>
	<div>			
		<p class="card-text-s">{{ $item->name }}</p>
		<p class="card-text-xs pt-5"><time datetime="2016-04-01T19:00">{{ $item->cash->created_at }}</time></p>
	</div>
</div>