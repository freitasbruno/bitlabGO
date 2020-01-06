function toggleTask (taskId) {		
	return $.ajax({
		url: "/tasks/toggleComplete/",
		method: "POST",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: {
			taskId: taskId
		}
	});
}

document.addEventListener("DOMContentLoaded", function(event) {

    // Toggle Task
    $(document).on('change', ".taskCheckbox" , function() {
		let element = $(this);
		let taskId = $(this).attr('data-id');	
		toggleTask(taskId).done(function(response) {
			if (!element.closest(".task-card").length) {
				getItems('tasks');
			}	
			console.log($(this));	
		});
	});

});
