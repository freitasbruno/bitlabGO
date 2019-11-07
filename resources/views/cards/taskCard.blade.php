<div class="card mb-2">
	<div class="d-flex justify-content-between p-2">
		<p class="m-0">
			<input class="taskCheckbox {{ $item->complete ? 'taskComplete' : false}}" type="checkbox"
				value="{{ $item->id }}" {{ $item->complete ? 'checked' : false}}>
			{{ $item->name }}
		</p>
		@component('components/itemTools')
		{{ 'tasks/' . $item->id }}
		@endcomponent
	</div>
</div>