<div class="modal-body">
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" name="name" class="form-control" id="name" value="{{ $item->name ?? '' }}" autocomplete="off" required>
	</div>
	<div class="form-group">
		<label for="description">Description</label>
		<textarea type="text" name="description" class="form-control" id="description" placeholder="Enter group description...">{{ $item->description ?? '' }}</textarea>
	</div>
</div>