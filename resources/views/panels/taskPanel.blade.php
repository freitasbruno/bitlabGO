<div class="card uk-card uk-card-hover">

	<!-- CARD BODY -->
	<div class="uk-grid">
		<p class="uk-width-expand uk-text-truncate">
			<input class="taskCheckbox {{ $item->task->complete ? 'taskComplete' : false}}" type="checkbox"
				value="{{ $item->id }}" {{ $item->task->complete ? 'checked' : false}}>
			{{ $item->name }}
		</p>
		<div class="uk-visible@s">Started: {{ $item->created_at->format("Y-m-d") }}</div>
		@if($item->complete)
			<div class="uk-visible@s">Finished: {{ $item->updated_at->format("Y-m-d") }}</div>
		@endif
		<div class="uk-width-auto">
			@component('components/itemTools')
			{{ 'tasks/' . $item->task->id }}
			@endcomponent
		</div>
	</div>
	<!-- CARD BODY -->

</div>