<div class="item-card timer-card"  data-id="{{ $item->timer->id }}" data-type="timers">
	<div class="timer-card-grid">		
		@if (!$item->timer->stop)
			<a href="#" class="timerStopBtn" data-id="{{ $item->timer->id }}">
				<i class="material-icons">stop</i>
			</a>
			<p class="card-text-s">{{ $item->name }}</p>
			<div></div>
			<p class="card-text-xs">Started at: {{ $item->timer->start }}</p>
		@else
			<div></div>
			{{-- <a href="#" class="timerStartBtn" data-id="{{ $item->timer->id }}"><i class="material-icons">play_arrow</i></a> --}}
			<p class="card-text-s">
				{{ $item->name }}
				{{-- <label id="minutes">00</label>:<label id="seconds">00</label> --}}
			</p>
			<div></div>
			<p class="card-text-xs">Duration: {{ date_diff(date_create($item->timer->stop), date_create($item->timer->start))->format('%d days, %H:%i:%s') }}</p>
		@endif
	</div>
</div>