function updateTimer (id, action) {
	console.log(action + " timer id: " + id);
	let url = "/timers/" + action;
	let data = {"id" : id};		
	return request (url, 'POST', data);
}

function startTimer (element) {
	let timerCard = element.closest('.timer-card');
	let itemId = timerCard.attr('data-id');

	timerCard.find(".timerStartBtn").toggle();
	timerCard.find(".timerStopBtn").toggle();
	updateTimer(itemId, 'start');	
	let daysLabel = timerCard.find(".days");		
	let hoursLabel = timerCard.find(".hours");		
	let minutesLabel = timerCard.find(".minutes");		
	let secondsLabel = timerCard.find(".seconds");
	let totalSeconds = 0;

	setInterval(setTime, 1000);

	function setTime() {
		++totalSeconds;
		secondsLabel.html(pad(totalSeconds % 60, 's'));
		if (totalSeconds > 60) {
			minutesLabel.html(pad(parseInt(totalSeconds / 60 % 60), 'm'));
		}
		if (totalSeconds > 60 * 60) {
		hoursLabel.html(pad(parseInt(totalSeconds / 60 / 60 % 24), 'h'));
		}
		if (totalSeconds > 60 * 60 * 24) {
		daysLabel.html(pad(parseInt(totalSeconds / 60 / 60 / 24), 'd'));
		}
	}

	function pad(val, suffix) {
		var valString = val + "";
		if (valString.length < 2) {
			return "0" + valString + suffix;
		} else {
			return valString + suffix;
		}
	}
}

document.addEventListener("DOMContentLoaded", function(event) {

	// Start Timer
	$(document).on('click', ".timerStartBtn" , function() {	
		startTimer($(this));			
	});

	// Stop Timer
	$(document).on('click', ".timerStopBtn" , function() {
		let timerCard = $(this).closest('.timer-card');
		let itemId = timerCard.attr('data-id');
		updateTimer(itemId, 'stop');
		index('timers').done(function(response) {
			render(response);		
		});
	});

});
