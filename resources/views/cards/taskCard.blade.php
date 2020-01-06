<div class="item-card task-card" data-id="{{ $item->task->id }}" data-type="tasks">
	<div class="task-card-grid">
		<label class="checkboxLabel">
			<input class="taskCheckbox {{ $item->task->complete ? 'taskComplete' : false}}" type="checkbox" data-id="{{ $item->task->id }}" 
				id="task-{{ $item->task->id }}" {{ $item->task->complete ? 'checked' : false}}>
			<label class="checkboxLabel" for="task-{{ $item->task->id }}"></label>
		</label>
		<p class="card-text-s">
			{{ $item->name }}
		</p>
	</div>
</div>