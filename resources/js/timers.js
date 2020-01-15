function updateTimer (id, action, totalSeconds = 0) {
	console.log(action + " timer id: " + id);
	let url = "/timers/" + action;
	let data = {
		"id" : id,
		"totalSeconds" : totalSeconds
	};		
	return request (url, 'POST', data);
}

function startTimer (element, start = 0) {
	let timerCard = element.closest('.timer-card');
	let itemId = timerCard.attr('data-id');

	timerCard.find(".timerStartBtn").toggle();
	timerCard.find(".timerStopBtn").toggle();
	//updateTimer(itemId, 'start');	
	let daysLabel = timerCard.find(".days");		
	let hoursLabel = timerCard.find(".hours");		
	let minutesLabel = timerCard.find(".minutes");		
	let secondsLabel = timerCard.find(".seconds");
	let days = daysLabel.html().length == 0 ? 0 : parseInt(daysLabel.html());		
	let hours = hoursLabel.html().length == 0 ? 0 : parseInt(hoursLabel.html());		
	let minutes = minutesLabel.html().length == 0 ? 0 : parseInt(minutesLabel.html());		
	let seconds = secondsLabel.html().length == 0 ? 0 : parseInt(secondsLabel.html());
	
	let totalSeconds = seconds + (minutes * 60) + (hours * 60 * 60) + (days * 60 * 60 * 24);

	setInterval(setTime, 1000);

	function setTime() {
		++totalSeconds;
		secondsLabel.html(pad(totalSeconds % 60, 's'));
		minutesLabel.html(pad(parseInt(totalSeconds / 60 % 60), 'm'));
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
		
		let daysLabel = timerCard.find(".days");		
		let hoursLabel = timerCard.find(".hours");		
		let minutesLabel = timerCard.find(".minutes");		
		let secondsLabel = timerCard.find(".seconds");
		let days = daysLabel.html().length == 0 ? 0 : parseInt(daysLabel.html());		
		let hours = hoursLabel.html().length == 0 ? 0 : parseInt(hoursLabel.html());		
		let minutes = minutesLabel.html().length == 0 ? 0 : parseInt(minutesLabel.html());		
		let seconds = secondsLabel.html().length == 0 ? 0 : parseInt(secondsLabel.html());
		let totalSeconds = seconds + (minutes * 60) + (hours * 60 * 60) + (days * 60 * 60 * 24);
		updateTimer(itemId, 'stop', totalSeconds);
		index('timers').done(function(response) {
			render(response);		
		});
	});

});
