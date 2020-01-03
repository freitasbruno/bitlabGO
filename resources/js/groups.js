
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

function deleteGroup (id) {		
	return $.ajax({
		url: "/groups/" + id,
		method: "DELETE",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed deleting group");
		}
	});
}

function updateCurrentGroup (id) {		
	return $.ajax({
		url: "/groups/current",
		method: "POST",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: {
			id : id
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed updating current group");
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

		if ($(e.target).closest(".group-card-action").length) { return };

		let id = $(this).attr('data-id');
		let groupCard = $(this);
		console.log("group: " + id);

		updateCurrentGroup(id).done(function(response) {
			$(".group-card").removeClass("selected");
			groupCard.addClass("selected");
			
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
		let actionBtn = $(this);
		let action = $(this).attr('data-action');
		let groupCard = $(this).closest(".group-card");
		let groupId = groupCard.attr('data-id');
		console.log(action + " group " + groupId);

		switch (action) {
			case 'expand':
				$("#nestedGroup-" + groupId).show(200);
				actionBtn.html('arrow_drop_up');	       
				actionBtn.attr('data-action', 'collapse');	       
				break;
			
			case 'collapse':
				$("#nestedGroup-" + groupId).hide(200);
				actionBtn.html('arrow_right');	       
				actionBtn.attr('data-action', 'expand');	       
				break;

			case 'open':
				getGroup(groupId).done(function(response) {
					renderModal(response);
				}); 		       
				break;

			case 'delete':
				deleteGroup(groupId).done(function(response) {
					groupCard.remove();
				}); 		       
				break;
		
			default:
				break;
		}
	});
});
