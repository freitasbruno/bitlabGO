<div class="item-card task-card">
	<div class="task-card-grid">
		<input class="taskCheckbox {{ $task->complete ? 'taskComplete' : false}}" type="checkbox"
			value="{{ $task->item->id }}" {{ $task->complete ? 'checked' : false}}>
		<p class="card-text-m">
			{{ $task->item->name }}
		</p>
	</div>
</div>