<div class="item-card task-card" data-id="{{ $task->id }}" data-type="tasks">
	<div class="task-card-grid">
		<label class="checkboxLabel">
			<input class="taskCheckbox {{ $task->complete ? 'taskComplete' : false}}" type="checkbox"
				id="task-{{ $task->id }}" {{ $task->complete ? 'checked' : false}}>
			<label class="checkboxLabel" for="task-{{ $task->id }}"></label>
		</label>
		<p class="card-text-s">
			{{ $task->item->name }}
		</p>
	</div>
</div>