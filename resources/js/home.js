function render (response) {	
	
	if (response.groups) {
		$("#filter-container").html('');
		$(response.html).hide().appendTo($("#filter-container")).fadeIn("slow");
	} else if (response.items) {
		$("#item-container").html('');
		$(response.html).hide().appendTo($("#item-container")).fadeIn("slow");
	}
		
	console.log(response);
}

function getCash () {		
	return $.ajax({
		url: "/cash",
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		error: function(errorThrown) {
			console.log("failed getting cash items");
		}
	});
}

function getTasks () {		
	return $.ajax({
		url: "/tasks",
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		error: function(errorThrown) {
			console.log("failed getting tasks");
		}
	});
}
	
function getTimers () {		
	return $.ajax({
		url: "/timers",
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		error: function(errorThrown) {
			console.log("failed getting timers");
		}
	});
}
	
function getBookmarks () {		
	return $.ajax({
		url: "/bookmarks",
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		error: function(errorThrown) {
			console.log("failed getting bookmarks");
		}
	});
}

function getItems (type) {
	switch (type) {
		case 'cash':				
			getCash().done(function(response) {
				render(response);
			}); 
			break;
	
		case 'tasks':
			getTasks().done(function(response) {
				render(response);
			}); 
			break;
	
		case 'timers':
			getTimers().done(function(response) {
				render(response);
			}); 
			break;
	
		case 'bookmarks':
			getBookmarks().done(function(response) {
				render(response);
			}); 
			break;
	
		default:
			break;
	}
}

document.addEventListener("DOMContentLoaded", function(event) {


});
