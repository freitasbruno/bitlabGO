<div class="container" data-id="{{ $item->task->id }}" data-type="tasks">

	<div class="main-card-detail-grid">
		<label class="checkboxLabel">
			<input class="taskCheckbox {{ $item->task->complete ? 'taskComplete' : false}}" type="checkbox" data-id="{{ $item->task->id }}" 
				id="task-detail-{{ $item->task->id }}" {{ $item->task->complete ? 'checked' : false}}>
			<label class="checkboxLabel" for="task-detail-{{ $item->task->id }}"></label>
		</label>
		<p class="card-text-m editable" data-field="name">
			{{ $item->name }}			
		</p>
		<div></div>
		@if ($item->description)		
			<p class="card-text-xs editable" data-field="description">{{ $item->description }}</p>
		@else
			<p class="card-text-xs editable" data-field="description">Enter a description...</p>
		@endif
	</div>

	@include('cards.itemCardDetails', ['item' => $item])
	
</div>