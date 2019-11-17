<div class="modal-body itemForm bookmarkForm">	
	<div class="form-group">
		<label for="name">URL</label>
		<input type="text" name="url" value="{{ $item->name ?? '' }}" class="form-control" id="url" placeholder="https://boltflow.com/..." autocomplete="off">
	</div>
	<input type="hidden" name="group" value="{{ session()->get('currentGroup')->id }}">	
</div>