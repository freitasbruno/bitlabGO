<form id="newGroupForm" action="#" method="post">
	<div id="formContent">
		<div class="modal-body groupForm">	
			<div class="form-group">
				<input type="text" name="name" value="{{ $group->name ?? '' }}" class="form-control" data-field="name" autocomplete="off" required>
				<span class="highlight"></span><span class="bar"></span>
				<label class="label">Enter a new group</label>
			</div>
			<br>
			<div class="form-group">
				<textarea type="text" name="description" class="form-control" data-field="description" autocomplete="off"></textarea>
				<span class="highlight"></span><span class="bar"></span>
				<label class="label">Enter group description</label>
			</div>
			<input type="hidden" name="group" value="{{ session()->get('currentGroup')->id }}">
		</div>
	</div>
	<div class="form-btns">
		<button class="btn btn-submit" type="submit">Save</button>
	</div>
</form>