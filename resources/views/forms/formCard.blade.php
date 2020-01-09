<div class="form-card" data-type="{{ $type }}">
	<a href="#" class="closeFormBtn"><i class="medium material-icons">close</i></a>
	<form class="form" action="#" method="post">	

		@include('forms.' . $formName)

		<input type="hidden" name="group" value="{{ session()->get('currentGroup')->id }}">
		<input type="hidden" name="type" value="{{ $type }}">
		
		<div class="form-btns">
			<button class="btn btn-submit" type="submit">Save</button>
		</div>
	</form>
</div>