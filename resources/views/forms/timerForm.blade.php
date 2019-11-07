<div class="modal-body">	
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" name="name" value="{{ $item->name ?? '' }}" class="form-control" id="name" placeholder="Coffee and biscuits..." autocomplete="off" required>
	</div>
	<div class="form-group">
		<label for="id_group">Group</label>
		<select name="group" class="form-control" id="id_group">
			<option value="session()->get('currentGroup')->id">{{ session()->get('currentGroup')->name ?? 'NONE' }}</option>
		</select>
	</div>	
</div>