<div class="container" data-id="{{ $item->timer->id }}" data-type="timer">

	<div class="main-card-detail-grid">
		@if (!$item->timer->stop)
			<a href="#" class="timerStopBtn" data-id="{{ $item->timer->id }}">
				<i class="material-icons">stop</i>
			</a>
			<p class="card-text-s">{{ $item->name }}</p>
			<div></div>
			<p class="card-text-xs">Started at: {{ $item->timer->start }}</p>
		@else
			<div></div>
			<p class="card-text-s">{{ $item->name }}</p>
			<div></div>
			<p class="card-text-xs">Duration: {{ date_diff(date_create($item->timer->stop), date_create($item->timer->start))->format('%d days, %H:%i:%s') }}</p>
		@endif
		<div></div>
		<div>
			<p class="card-text-xs">{{ $item->description }}</p>
		</div>
	</div>

	@include('cards.itemCardDetails', ['item' => $item])
	
</div>