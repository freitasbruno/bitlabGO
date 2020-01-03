
function newGroup () {		
	return $.ajax({
		url: "/groups/create",
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting group form");
		}
	});
}

function getGroup (id) {		
	return $.ajax({
		url: "/groups/" + id,
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting group");
		}
	});
}

function getGroups (id = 0) {		
	return $.ajax({
		url: "/groups",
		method: "GET",
		data: {
			id : id
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

document.addEventListener("DOMContentLoaded", function(event) {

	getGroups().done(function(response) {
		render(response);		
	});
	
	// GET GROUP
    $(document).on('click', '.group-card', function(e) {
		if ($(e.target).closest(".groupTools").length) { return };
		let type = $(this).attr('data-type');
		let id = $(this).attr('data-id');
		console.log(type + " group: " + id);
		
		getGroups(id).done(function(response) {
			render(response);
			
			let selected = $(".filter-link.selected");
			
			if (selected.length) {
				let itemType = $(selected).attr('data-url');
				console.log('itemType = ' + itemType);
	
				getItems (itemType);
			}
		});

	});
	
	// GROUP ACTIONS
    $(document).on('click', '.group-card-action', function(e) {
		let action = $(this).attr('data-action');
		let groupId = $(this).closest(".group-card").attr('data-id');
		console.log(action + " group " + groupId);

		switch (action) {
			case 'open':
				getGroup(groupId).done(function(response) {
					renderModal(response);
				}); 		       
				break;
		
			default:
				break;
		}
	});
});
