<div class="container" data-id="{{ $item->task->id }}" data-type="task">

	<div class="main-card-detail-grid">
		<label class="checkboxLabel">
			<input class="taskCheckbox {{ $item->task->complete ? 'taskComplete' : false}}" type="checkbox"
				id="task-detail-{{ $item->task->id }}" {{ $item->task->complete ? 'checked' : false}}>
			<label class="checkboxLabel" for="task-detail-{{ $item->task->id }}"></label>
		</label>
		<p class="card-text-m">
			{{ $item->name }}			
		</p>
		<div></div>
		<div>
			<p class="card-text-xs">{{ $item->description }}</p>
		</div>
	</div>

	@include('cards.itemCardDetails', ['item' => $item])
	
</div>