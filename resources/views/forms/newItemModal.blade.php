<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="form">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="itemModalTitle"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="itemForm" action="#" method="post">
				@csrf
				<div id="formContent">
					@include('forms.groupForm')
					@include('forms.bookmarkForm')
					@include('forms.cashItemForm')
					@include('forms.taskForm')
					@include('forms.timerForm')
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>