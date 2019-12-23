<form id="newItemForm" action="#" method="post">
	<div id="formContent">
		@include('forms.' . $itemType . 'Form')
	</div>
	<div class="form-btns">
		<button class="btn btn-submit" type="submit">Save</button>
	</div>
</form>