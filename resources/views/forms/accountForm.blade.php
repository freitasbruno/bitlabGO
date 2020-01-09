<div class="form-group">
	<input type="text" name="name" value="{{ $account->group->name ?? '' }}" class="form-control" data-field="name" autocomplete="off" required>
	<span class="highlight"></span><span class="bar"></span>
	<label class="label">Enter a new account</label>
</div>
<br>
<div class="form-group">
	<textarea type="text" name="description" class="form-control" data-field="description" autocomplete="off" required></textarea>
	<span class="highlight"></span><span class="bar"></span>
	<label class="label">Enter account description</label>
</div>