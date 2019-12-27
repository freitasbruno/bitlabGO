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
		let taskId = $(this).closest(".task-card").attr('data-id');	
		toggleTask(taskId).done(function(response) {
			console.log($(this));	
		});
	});

});
