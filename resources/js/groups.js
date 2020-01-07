
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

function moveGroup (groupId, targetId) {		
	return $.ajax({
		url: "/groups/move/" + groupId,
		method: "POST",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: {
			targetId : targetId
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed updating current group");
		}
	});
}

function moveItem (type, id, targetId) {		
	return $.ajax({
		url: "/" + type + "/move/" + id,
		method: "POST",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: {
			targetId : targetId
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed updating current group");
		}
	});
}

document.addEventListener("DOMContentLoaded", function(event) {
	
	// GET GROUP
    $(document).on('click', '.group-card', function(e) {

		if ($(e.target).closest(".group-card-action").length) { return };

		let id = $(this).attr('data-id');
		let groupCard = $(this);
		console.log("group: " + id);

		updateCurrentGroup(id).done(function(response) {
			$(".group-card").removeClass("selected");
			groupCard.addClass("selected");
			
			let selected = $(".item-filter-link.selected");
			
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
		let type = groupCard.closest('.modal').attr('data-type');
		let target = type == 'groupSelect' ? '#nestedListGroup-' : '#nestedGroup-';

		switch (action) {
			case 'expand':
				$(target + groupId).show();
				actionBtn.html('arrow_drop_up');	       
				actionBtn.attr('data-action', 'collapse');	       
				break;
			
			case 'collapse':
				$(target + groupId).hide();
				actionBtn.html('arrow_right');	       
				actionBtn.attr('data-action', 'expand');	       
				break;

			case 'open':
				getGroup(groupId).done(function(response) {
					console.log(JSON.parse(response.group));
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
	
	// MOVE GROUP
    $(document).on('click', '.selectGroupBtn', function(e) {

		let container = $(this).closest('.modal').find('.container');
		let id = container.attr('data-id');
		let type = container.attr('data-type');
		getGroups('groupSelect').done(function(response) {
			response.actionObjectType = type;
			response.actionObjectId = id;
			renderModal(response);		
		});
		console.log("Move " + type + ": " + id);
	});

    $(document).on('click', '.group-list-card', function(e) {

		if (!$(e.target).closest('.group-card-action').length) {

			let type = $(this).closest('.container').attr('data-type');
			let id = $(this).closest('.container').attr('data-id');
			let targetId = $(this).attr('data-id');

			switch (type) {
				case 'groups':
					moveGroup(id, targetId).done(function(response) {
						let group = JSON.parse(response.group);	
						closeModal('groupSelect');
						getGroups('cardPanel').done(function(response) {
							render(response);		
						});
						getGroup(group.id).done(function(response) {
							renderModal(response);
						});
					});
					break;					
				default:
					moveItem(type, id, targetId).done(function(response) {	
						closeModal('groupSelect');
						closeModal('item');
						//getItems(type);
					});
					break;
			}
		}
	});
});
