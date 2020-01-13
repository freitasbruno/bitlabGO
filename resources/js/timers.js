function updateTimer (itemId, action) {
	return $.ajax({
		url: "/timers/" + action,
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

	// Start Timer
	$(document).on('click', ".timerStartBtn" , function() {
		var itemId = $(this).attr('data-id');
		// updateTimer(itemId, 'start');
		// index('timers');		
		var minutesLabel = document.getElementById("minutes");
		var secondsLabel = document.getElementById("seconds");
		var totalSeconds = 0;
		setInterval(setTime, 1000);

		function setTime() {
			++totalSeconds;
			secondsLabel.innerHTML = pad(totalSeconds % 60);
			minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
		}

		function pad(val) {
			var valString = val + "";
			if (valString.length < 2) {
				return "0" + valString;
			} else {
				return valString;
			}
		}
	});

	// Stop Timer
	$(document).on('click', ".timerStopBtn" , function() {
		var itemId = $(this).attr('data-id');
		updateTimer(itemId, 'stop');
		index('timers').done(function(response) {
			render(response);		
		});
	});

});
