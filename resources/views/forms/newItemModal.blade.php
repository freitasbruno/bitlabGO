<div class="modal" id="itemModal">
	<div class="modal-dialog">
		<div class="modal-header">
			<h5 class="modal-title" id="itemModalTitle"></h5>
			<button type="button"></button>
		</div>
		<form id="itemForm" action="#" method="post">
			@csrf
			<div id="formContent">
				@include('forms.groupForm')
				@include('forms.bookmarkForm')
				@include('forms.cashForm')
				@include('forms.taskForm')
				@include('forms.timerForm')
			</div>
			<div class="uk-text-right uk-padding-small">
				<button type="button">Close</button>
				<button type="submit">Save</button>
			</div>
		</form>
	</div>
</div>