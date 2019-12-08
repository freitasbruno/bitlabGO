<div class="cash-card">
	<div class="uk-grid-small" uk-grid>
		<div class="uk-width-auto">
			@if ($cash -> type == 'expense')
				<span class="icon-expense" uk-icon="icon: arrow-down; ratio: 2"></span>				
			@else
				<span class="icon-income" uk-icon="icon: arrow-up; ratio: 2"></span>					
			@endif
		</div>
		<div class="uk-width-expand uk-flex-middle">
			<p class="card-text-main">€{{ $cash->amount }}</p>
			<p class="card-text-normal">{{ $cash->item->name }}</p>
			<p class="card-text-small"><time datetime="2016-04-01T19:00">{{ $cash->created_at }}</time></p>
		</div>
	</div>
</div>