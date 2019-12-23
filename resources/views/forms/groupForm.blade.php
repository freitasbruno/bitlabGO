<div class="modal-body itemForm groupForm">
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" name="groupName" class="form-control" data-field="name" value="{{ $item->name ?? '' }}" autocomplete="off">
	</div>
	<div class="form-group">
		<label for="description">Description</label>
		<textarea type="text" name="groupDescription" class="form-control" data-field="description" placeholder="Enter group description...">{{ $item->description ?? '' }}</textarea>
	</div>
	<input type="hidden" name="group" value="{{ session()->get('currentGroup')->id }}">
</div>