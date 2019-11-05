<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="form">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="taskModalTitle">New Task</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/tasks" method="post">
				@csrf
				@include('forms.taskForm')
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>