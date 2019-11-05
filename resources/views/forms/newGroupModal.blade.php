<div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="groupModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="form">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="groupModalTitle">New Group</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/home" method="post">
				@csrf
				@include('forms.groupForm')
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>