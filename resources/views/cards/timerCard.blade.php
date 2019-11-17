<div class="card mb-2">
	<div class="d-flex justify-content-between p-2">
		<p class="m-0">
			@if (!$item->timer->stop)
		<button type="button" class="btn btn-secondary timerStopBtn" value="{{ $item->id }}">Stop</button>
				{{ $item->name }} - Started at: {{ $item->start }}
			@else
				{{ $item->name }} Duration: {{ date_diff(date_create($item->timer->stop), date_create($item->timer->start))->format('%d days, %H:%i:%s') }}
			@endif			
		</p>
		@component('components/itemTools')
		{{ 'timers/' . $item->timer->id }}
		@endcomponent
	</div>
</div>