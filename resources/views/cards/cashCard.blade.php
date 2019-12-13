<div class="cash-card" data-id="{{ $cash->id }}" data-type="cash">
	<a href="#cash-moda-{{ $cash->id }}" uk-toggle>
		<div class="uk-grid-small" uk-grid>
			<div class="uk-width-auto">
				@if ($cash -> type == 'expense')
					<span class="icon-expense" uk-icon="icon: arrow-down; ratio: 2"></span>				
				@else
					<span class="icon-income" uk-icon="icon: arrow-up; ratio: 2"></span>					
				@endif
			</div>
			<div class="uk-width-expand uk-flex-middle">
				<p class="card-text-xl">€{{ $cash->amount }}</p>
				<p class="card-text-m">{{ $cash->item->name }}</p>
				<p class="card-text-s"><time datetime="2016-04-01T19:00">{{ $cash->created_at }}</time></p>
			</div>
		</div>
	</a>
</div>