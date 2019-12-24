<div class="container" data-id="{{ $task->id }}" data-type="task">

	<div class="main-card-detail-grid">
		<label class="checkboxLabel">
			<input class="taskCheckbox {{ $task->complete ? 'taskComplete' : false}}" type="checkbox"
				id="task-detail-{{ $task->id }}" {{ $task->complete ? 'checked' : false}}>
			<label class="checkboxLabel" for="task-detail-{{ $task->id }}"></label>
		</label>
		<p class="card-text-m">
			{{ $task->item->name }}			
		</p>
		<div></div>
		<div>
			<p class="card-text-xs">{{ $task->item->description }}</p>
		</div>
	</div>

	@include('cards.cardDetails', ['item' => $task->item])
	
</div>