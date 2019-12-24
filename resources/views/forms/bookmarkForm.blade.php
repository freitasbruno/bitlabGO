<div class="modal-body itemForm bookmarkForm">	
	<div class="form-group">
		<input type="text" name="url" value="{{ $item->name ?? '' }}" class="form-control" data-field="url" required>
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">URL</label>
	</div>
	<input type="hidden" name="group" value="{{ session()->get('currentGroup')->id }}">
	<input type="hidden" name="itemType" value="bookmarks">
</div>