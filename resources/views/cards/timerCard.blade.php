<div class="item-card timer-card"  data-id="{{ $timer->id }}" data-type="timers">
	<div class="timer-card-grid">		
		@if (!$timer->stop)
			<a href="#" class="timerStopBtn" data-id="{{ $timer->id }}">
				<i class="material-icons">stop</i>
			</a>
			<p class="card-text-s">{{ $timer->item->name }}</p>
			<div></div>
			<p class="card-text-xs">Started at: {{ $timer->start }}</p>
		@else
			<div></div>
			<p class="card-text-s">{{ $timer->item->name }}</p>
			<div></div>
			<p class="card-text-xs">Duration: {{ date_diff(date_create($timer->stop), date_create($timer->start))->format('%d days, %H:%i:%s') }}</p>
		@endif
	</div>
</div>