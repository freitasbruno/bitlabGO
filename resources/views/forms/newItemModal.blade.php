<div class="modal" id="itemModal" uk-modal>
	<div class="modal-dialog modal-dialog-centered" role="form">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="itemModalTitle"></h5>
				<button type="button" class="close uk-modal-close" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
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
				<div class="modal-footer">
					<button type="button" class="uk-modal-close">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>