<div class="form-card" data-type="{{ $type }}">
	<i class="medium material-icons icon-btn closeFormBtn">close</i>
	<form class="form" action="#" method="post">	

		@include('forms.' . $formName)

		<input type="hidden" name="group" value="{{ session()->get('currentGroup')->id }}">
		<input type="hidden" name="type" value="{{ $type }}">
		
		<div class="form-btns">
			<button class="btn btn-submit" type="submit">Save</button>
		</div>
	</form>
</div>