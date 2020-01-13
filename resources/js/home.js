function request (url, method, data = null) {	

	return $.ajax({
		url: url,
		method: method,
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: data,
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed @" + url + " - method: " + method);
		}
	});

}

function render (response) {	
	
	if (response.groups || response.accounts) {
		$("#filter-container").html('');
		$(response.html).hide().appendTo($("#filter-container")).fadeIn(200);
		$(".nestedGroup").hide();
	} else if (response.items) {
		$("#item-container").html('');
		$(response.html).hide().appendTo($("#item-container")).fadeIn(200);
	}
		
	console.log(response);
}

function show (id, type) {	
	console.log("Show " + type + " - id: " + id);
	let url = "/" + type + "/" + id;	
	return request (url, 'GET');
}

function destroy (id, type) {
	console.log("Destroy " + type + " - id: " + id);	
	let url = "/" + type + "/" + id;
	return request (url, 'DELETE');
}

function create (type) {
	let url = "/" + type + "/create";	
	return request (url, 'GET');
}

function move (type, id, targetId) {
	console.log("Move " + type + " - id: " + id + " to parent with id: " + targetId);
	let url = "/" + type + "/move/" + id;
	let data = {"targetId" : targetId};	
	return request (url, 'POST', data);		
}

function index (type, display = null) {
	console.log("Index " + type);
	let url = "/" + type;	
	return request (url, 'GET');
}

function getGroups (viewType = 'cardPanel') {		
	return $.ajax({
		url: "/groups",
		method: "GET",
		data: {
			viewType : viewType,
		},
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting groups");
		}
	});
}

function getAccounts (viewType = 'cardPanel') {		
	return $.ajax({
		url: "/accounts",
		method: "GET",
		data: {
			viewType : viewType,
		},
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting accounts");
		}
	});
}

document.addEventListener("DOMContentLoaded", function(event) {

	getGroups('cardPanel').done(function(response) {
		render(response);		
	});
	index('cash').done(function(response) {
		render(response);		
	});

	// TOGGLE FILTERS/ITEMS
	$(document).on('click', '.toggleDisplayBtn', function() {
		
		$(".toggleDisplayBtn").toggle();
		$("#filter-container").toggle();
		$("#item-container").toggle();

	});
});
