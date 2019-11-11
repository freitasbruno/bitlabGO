<div class="modal-body itemForm timerForm">	
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" name="timerName" value="{{ $item->name ?? '' }}" class="form-control" id="name" placeholder="Coffee and biscuits..." autocomplete="off">
	</div>
	<div class="form-group">
		<input type="hidden" name="group" value="{{ session()->get('currentGroup')->id }}">
	</div>	
</div>