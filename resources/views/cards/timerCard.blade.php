<div class="card item-card timer-card"  data-id="{{ $item->timer->id }}" data-type="timers">	
	
	@if (!$item->timer->stop)
		<i class="material-icons icon-btn icon-36 timerStopBtn">stop</i>
		<div>
			<p class="card-text-s">{{ $item->name }}</p>
			<p class="card-text-xs">Started at: {{ $item->timer->start }}</p>
		</div>
		<div class="timer-counter"></div>
	@else
		<i class="material-icons icon-btn icon-36 timerStartBtn">play_arrow</i>
		<div>
			<p class="card-text-s">
				{{ $item->name }}
			</p>
			<p class="card-text-xs">Duration: {{ date_diff(date_create($item->timer->stop), date_create($item->timer->start))->format('%d days, %H:%i:%s') }}</p>
		</div>
		<div class="timer-counter">
			<label class="days"></label> 
			<label class="hours"></label>
			<label class="minutes"></label>
			<label class="seconds">{{ $item->timer->times['seconds'] }}</label>
		</div>
	@endif
</div>