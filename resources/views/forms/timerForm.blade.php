<div class="modal-body itemForm timerForm">	
	<div class="form-group">
		<input type="text" name="name" value="{{ $item->name ?? '' }}" class="form-control" data-field="name" autocomplete="off" required>
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Enter a name for your new timer</label>
	</div>
</div>