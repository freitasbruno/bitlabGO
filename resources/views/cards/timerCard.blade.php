<div class="card item-card timer-card"  data-id="{{ $item->timer->id }}" data-type="timers">	
	@if (!$item->timer->stop)
		<i class="material-icons icon-btn icon-36 timerStopBtn" data-id="{{ $item->timer->id }}">stop</i>
		<div>
			<p class="card-text-s">{{ $item->name }}</p>
			<p class="card-text-xs">Started at: {{ $item->timer->start }}</p>
		</div>
	@else
		<i class="material-icons icon-btn icon-36 timerStartBtn" data-id="{{ $item->timer->id }}">play_arrow</i>
		<div>
			<p class="card-text-s">
				{{ $item->name }}
				{{-- <label id="minutes">00</label>:<label id="seconds">00</label> --}}
			</p>
			<p class="card-text-xs">Duration: {{ date_diff(date_create($item->timer->stop), date_create($item->timer->start))->format('%d days, %H:%i:%s') }}</p>
		</div>
	@endif
</div>