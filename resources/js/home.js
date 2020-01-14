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

function index (type, viewType = null) {
	console.log("Index " + type);
	let url = "/" + type;
	let data = {"viewType" : viewType};		
	return request (url, 'GET', data);
}

function get (type, id) {	
	console.log("Show " + type + " - id: " + id);
	let url = "/" + type + "/" + id;	
	return request (url, 'GET');
}

function destroy (type, id) {
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

document.addEventListener("DOMContentLoaded", function(event) {

	index('groups', 'cardPanel').done(function(response) {
		render(response);		
	});
	index('cash').done(function(response) {
		render(response);		
	});
});
