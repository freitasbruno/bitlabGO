<div class="modal-body itemForm taskForm">	
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" name="taskName" value="{{ $item->name ?? '' }}" class="form-control" data-field="name" placeholder="Coffee and biscuits..." autocomplete="off">
	</div>
	<input type="hidden" name="group" value="{{ session()->get('currentGroup')->id }}">
</div>