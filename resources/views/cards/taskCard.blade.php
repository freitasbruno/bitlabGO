<div class="card mb-2">
	<div class="d-flex justify-content-between p-2">
		<p class="m-0">
			<input class="taskCheckbox {{ $item->task->complete ? 'taskComplete' : false}}" type="checkbox"
				value="{{ $item->id }}" {{ $item->task->complete ? 'checked' : false}}>
			{{ $item->name }}
		</p>
		@component('components/itemTools')
		{{ 'tasks/' . $item->task->id }}
		@endcomponent
	</div>
</div>