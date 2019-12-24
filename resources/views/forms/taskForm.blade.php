<div class="modal-body itemForm taskForm">
	<div class="form-group">
		<input type="text" name="name" value="{{ $item->name ?? '' }}" class="form-control" data-field="name" autocomplete="off" required>
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Enter a new task</label>
	</div>
	<input type="hidden" name="group" value="{{ session()->get('currentGroup')->id }}">
	<input type="hidden" name="itemType" value="tasks">
</div>