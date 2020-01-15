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
			let task = JSON.parse(response.task);
			let taskCard = element.closest(".task-card");
			taskCard.toggleClass('complete');
			if (task.complete) {
				taskCard.appendTo(taskCard.closest(".cardScrollbar"));
				console.log('complete');
			} else {
				taskCard.prependTo(taskCard.closest(".cardScrollbar"));
			}
			console.log(task.complete);	
		});
	});

});
