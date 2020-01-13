<div class="container" data-id="{{ $item->timer->id }}" data-type="timers">

	<div class="main-card-detail-grid">
		@if (!$item->timer->stop)
			<a href="#" class="timerStopBtn" data-id="{{ $item->timer->id }}">
				<i class="material-icons icon-btn">stop</i>
			</a>
			<p class="card-text-s editable" data-field="name">{{ $item->name }}</p>
			<div></div>
			<p class="card-text-xs">Started at: {{ $item->timer->start }}</p>
		@else
			<div></div>
			<p class="card-text-s editable" data-field="name">{{ $item->name }}</p>
			<div></div>
			<p class="card-text-xs">Duration: {{ date_diff(date_create($item->timer->stop), date_create($item->timer->start))->format('%d days, %H:%i:%s') }}</p>
		@endif
		<div></div>
		@if ($item->description)		
			<p class="card-text-xs editable" data-field="description">{{ $item->description }}</p>
		@else
			<p class="card-text-xs editable" data-field="description">Enter a description...</p>
		@endif
	</div>

	@include('cards.itemCardDetails', ['item' => $item])
	
</div>