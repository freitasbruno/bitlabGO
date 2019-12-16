<div class="item-card timer-card">
	<div class="timer-card-grid">
		<p class="card-text-m">
			@if (!$timer->stop)
				<button type="button" class="btn btn-secondary timerStopBtn" value="{{ $timer->id }}">Stop</button>
				{{ $timer->item->name }} - Started at: {{ $timer->item->start }}
			@else
				{{ $timer->item->name }} Duration: {{ date_diff(date_create($timer->stop), date_create($timer->start))->format('%d days, %H:%i:%s') }}
			@endif			
		</p>
	</div>
</div>