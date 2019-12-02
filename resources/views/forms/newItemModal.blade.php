<div class="modal" id="itemModal" uk-modal>
	<div class="uk-modal-dialog uk-margin-auto-vertical">
		<div class="uk-modal-header">
			<h5 class="modal-title" id="itemModalTitle"></h5>
			<button class="uk-modal-close-default" type="button" uk-close></button>
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
				<button type="button" class="uk-button uk-button-default uk-modal-close">Close</button>
				<button type="submit" class="uk-button uk-button-primary">Save</button>
			</div>
		</form>
	</div>
</div>