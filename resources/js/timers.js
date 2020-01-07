function stopTimer (itemId) {
	return $.ajax({
		url: "/timers/stop/",
		method: "POST",
		dataType: 'json',
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: {
			itemId: itemId
		},
		success: function(response) {
			console.log(response);
		},
		error: function(error) {
			console.log("failed getting item");
			console.log(error);
		}
	});
}

document.addEventListener("DOMContentLoaded", function(event) {

	// Stop Timer
	$(document).on('click', ".timerStopBtn" , function() {
		var itemId = $(this).attr('data-id');
		stopTimer(itemId);
		$(".item-filter-link.selected").trigger("click");
	});

});
